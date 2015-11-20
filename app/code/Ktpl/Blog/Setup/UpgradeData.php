<?php

namespace Ktpl\Blog\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.2') < 0) {
            // Get tutorial_simplenews table
            $tableName = $setup->getTable('ktpl_blog');
            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                // Declare data
                $data = [
                    'banner' => [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        'nullable' => false,
                        'comment' => 'Banner',
                    ],
                ];

                // Insert data to table
                $connection = $setup->getConnection();
                foreach ($data as $name => $definition) {
                    $connection->addColumn($tableName, $name, $definition);
                }

              //  $installer->endSetup();
            }
        }

        $setup->endSetup();
    }
}