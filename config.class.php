<?php

class Config
{
    public function __construct()
    {
        self::_dbSettings();
        self::_svcSetting();
        if (isset($_REQUEST['node']) && $_REQUEST['node'] === 'schema') {
            self::_initSetting();
        }
    }

    private static function _dbSettings()
    {
        define('DATABASE_TYPE',     'mysql');
        define('DATABASE_HOST',     getenv('DB_HOST') ?: 'db');
        define('DATABASE_NAME',     getenv('DB_NAME') ?: 'fog');
        define('DATABASE_USERNAME', getenv('DB_USER') ?: 'fog');
        define('DATABASE_PASSWORD', getenv('DB_PASS') ?: 'fogpassword');
    }

    private static function _svcSetting()
    {
        define('UDPSENDERPATH',         '/usr/local/sbin/udp-sender');
        define('MULTICASTINTERFACE',    getenv('MULTICAST_INTERFACE') ?: 'eth0');
        define('UDPSENDER_MAXWAIT',     null);
        $sloppy = strtolower(getenv('USE_SLOPPY_NAME_LOOKUPS') ?? 'true');
        define('USE_SLOPPY_NAME_LOOKUPS', ($sloppy !== 'false' && $sloppy !== '0'));
    }

    private static function _initSetting()
    {
        define('TFTP_HOST',               getenv('TFTP_HOST') ?: 'tftp');
        define('TFTP_PXE_KERNEL_DIR',     getenv('TFTP_KERNEL_DIR') ?: '/var/www/html/fog/service/ipxe/');
        define('PXE_KERNEL',              getenv('PXE_KERNEL') ?: 'bzImage');
        define('PXE_KERNEL_RAMDISK',      getenv('PXE_KERNEL_RAMDISK') ?: 127000);
        define('MEMTEST_KERNEL',          getenv('MEMTEST_KERNEL') ?: 'memtest.bin');
        define('PXE_IMAGE',               getenv('PXE_IMAGE') ?: 'init.xz');
        define('TFTP_FTP_USERNAME',       getenv('FTP_USER') ?: 'fog');
        define('TFTP_FTP_PASSWORD',       getenv('FTP_PASS') ?: 'fogftp');
        define('STORAGE_HOST',            getenv('STORAGE_HOST') ?: 'nfs');
        define('STORAGE_DATADIR',         getenv('STORAGE_DATADIR') ?: '/images/');
        define('STORAGE_DATADIR_CAPTURE', getenv('STORAGE_DATADIR_CAPTURE') ?: '/images/dev');
        define('STORAGE_FTP_USERNAME',    getenv('FTP_USER') ?: 'fog');
        define('STORAGE_FTP_PASSWORD',    getenv('FTP_PASS') ?: 'fogftp');
        define('STORAGE_BANDWIDTHPATH',   getenv('STORAGE_BANDWIDTHPATH') ?: '/fog/status/bandwidth.php');
        define('STORAGE_INTERFACE',       getenv('STORAGE_INTERFACE') ?: 'eth0');
        define('SNAPINDIR',               getenv('SNAPINDIR') ?: '/opt/fog/snapins/');
        define('FOG_THEME',               getenv('FOG_THEME') ?: 'default');
        define('CAPTURERESIZEPCT',        getenv('CAPTURERESIZEPCT') ?: 5);
        define('WEB_HOST',                getenv('WEB_HOST') ?: getenv('DB_HOST') ?: 'db');
        define('WOL_HOST',                getenv('WOL_HOST') ?: 'fog');
        define('WOL_PATH',                getenv('WOL_PATH') ?: '//fog/wol/wol.php');
        define('WOL_INTERFACE',           getenv('WOL_INTERFACE') ?: 'eth0');
        define('SNAPINDIR',               getenv('SNAPINDIR') ?: '/opt/fog/snapins/');
        define('QUEUESIZE',               getenv('QUEUESIZE') ?: 10);
        define('CHECKIN_TIMEOUT',         getenv('CHECKIN_TIMEOUT') ?: 600);
        define('USER_MINPASSLENGTH',      getenv('USER_MINPASSLENGTH') ?: 4);
        define('NFS_ETH_MONITOR',         getenv('NFS_ETH_MONITOR') ?: 'eth0');
        define('UDPCAST_INTERFACE',       getenv('UDPCAST_INTERFACE') ?: 'eth0');
        define('UDPCAST_STARTINGPORT',    getenv('UDPCAST_STARTINGPORT') ?: 63100);
        define('FOG_MULTICAST_MAX_SESSIONS', getenv('FOG_MULTICAST_MAX_SESSIONS') ?: 64);
        define('FOG_JPGRAPH_VERSION',     getenv('FOG_JPGRAPH_VERSION') ?: '2.3');
        define('FOG_REPORT_DIR',          getenv('FOG_REPORT_DIR') ?: './reports/');
        define('FOG_CAPTUREIGNOREPAGEHIBER', getenv('FOG_CAPTUREIGNOREPAGEHIBER') ?: true);
    }
}
