<?php

$installer = $this;
$tableBanners = $installer->getTable('mojambanners/table_banners');
$installer->startSetup();
$installer->getConnection()->dropTable($tableBanners);
$table = $installer->getConnection()
    ->newTable($tableBanners)
    ->addColumn('banners_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable'  => false,
        ))
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable'  => false,
        ))
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, '30', array(
        'nullable'  => false,
        ))
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, '255', array(
        'nullable'  => false,
    ));
$installer->getConnection()->createTable($table);

$installer->endSetup();