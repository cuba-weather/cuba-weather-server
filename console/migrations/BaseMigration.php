<?php
/**
 * Created by PhpStorm.
 * User: glpz
 * Date: 4/12/18
 * Time: 15:26
 */

namespace console\migrations;

use yii\db\Migration;

class BaseMigration extends Migration
{

    /**
     * @var string
     */
    protected $tableOptions;
    protected $restrict = 'RESTRICT';
    protected $cascade = 'CASCADE';
    protected $dbType;


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        switch ($this->db->driverName) {
            case 'mysql':
                $this->tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                $this->dbType = 'mysql';
                break;
            case 'pgsql':
                $this->tableOptions = null;
                $this->dbType = 'pgsql';
                break;
            case 'dblib':
            case 'mssql':
            case 'sqlsrv':
                $this->restrict = 'NO ACTION';
                $this->tableOptions = null;
                $this->dbType = 'sqlsrv';
                break;
            default:
                throw new \RuntimeException('Your database is not supported!');
        }
    }

    public function dropColumnConstraints($table, $column)
    {
        $table = str_replace(['{{%', '}}'], ['', ''], $table);
        $table = $this->db->schema->getRawTableName($table);
        $cmd = $this->db->createCommand('SELECT name FROM sys.default_constraints
                                WHERE parent_object_id = object_id(:table)
                                AND type = \'D\' AND parent_column_id = (
                                    SELECT column_id 
                                    FROM sys.columns 
                                    WHERE object_id = object_id(:table)
                                    and name = :column
                                )', [ ':table' => $table, ':column' => $column ]);

        $constraints = $cmd->queryAll();
        foreach ($constraints as $c) {
            $this->execute('ALTER TABLE '.$this->db->quoteTableName($table).' DROP CONSTRAINT '.$this->db->quoteColumnName($c['name']));
        }
    }

    public function createTable($table, $columns, $options = null)
    {
        $table = str_replace(['{{%', '}}'], ['', ''], $table);
        $columns = array_merge($columns, [
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
        ]);

        parent::createTable($table, $columns, $options);

        $this->addForeignKey(
            'fk-'. "{$table}" .'-created_by',
            $table,
            'created_by',
            'user',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-'. "{$table}" .'-updated_by',
            $table,
            'updated_by',
            'user',
            'id',
            'NO ACTION'
        );
    }

}
