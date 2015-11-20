<?php
 
namespace Ktpl\Manufacturer\Setup;
   
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class InstallSchema implements InstallSchemaInterface
{   
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {       
        $installer = $setup;
        $installer->startSetup();
 
        // Get tutorial_simplenews table
        $tableName = $installer->getTable('ktpl_manufacturer');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            // Create tutorial_simplenews table
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn('id',Table::TYPE_INTEGER,null,['identity' => true,'unsigned' => true,'nullable' => false,'primary' => true],'ID')
                ->addColumn('name',Table::TYPE_TEXT,null,['nullable' => false, 'default' => ''],'Name')
                ->addColumn('image_path',Table::TYPE_TEXT,null,['nullable' => false, 'default' => ''],'Image Path')
                ->addColumn('description',Table::TYPE_TEXT,null,['nullable' => false, 'default' => ''],'Description')
                ->addColumn('created_at',Table::TYPE_DATETIME,null,['nullable' => false],'Created At')
                ->addColumn('status',Table::TYPE_SMALLINT,null,['nullable' => false, 'default' => '0'],'Status')
                ->addColumn('position',Table::TYPE_INTEGER,null,['nullable' => false, 'default' => '0'],'Position')
                ->setComment('Manufacturer Table')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }
 
        $installer->endSetup();
    }
}