<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'woofwarr_wordpress314');

/** MySQL database username */
define('DB_USER', 'woofwarr_word314');

/** MySQL database password */
define('DB_PASSWORD', 'UkwD9izfRvRk');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '<f*yS-Ka|!NP]q$TyXgJ$D>uLC<*iGzTieTL!AXCBUn/-dusa(CcoMd@[q$imLv$;GeSF-<QlJLR_GvvaYUD(eS/V_VhZMvIENy%btYfok%QdOgKSg_Jsbl?kZ-lj*t>');
define('SECURE_AUTH_KEY', 'MC@)@<D!++L(QxdHpByA%(qWAn-ztMPJbZT}>gHIT{/_<eyE@;lIADS-^{//fBhS{[amw;@KR;S>MS|;<?OYPL>*Qw[Zd|XKw(yTE{FwJ^)K/N[c_z))Q!pTIT>uYvWe');
define('LOGGED_IN_KEY', 'AHtRRGrjgCbAsK-X(ACtC(fHdul{QffBhqx]{&UZur!lx[ri?oUp}B&l$mNidSIPdfSbEV+q-ZGV_vKrJ=;@=fLeY&;Q|Te-UvTdZr+y}olzrp?Dg{o=g%d>jzVO[kqq');
define('NONCE_KEY', '&@FcAo=kW+bV$mU$>FN?>TjI?+b{eDtJ/>{|zlD=oczg)LcuDVVKNIi}@jsotzw+_Glz;)DG>meTajTMQ!I>izM>oh)HUSI<|o@m]E;D/|?eMj/$I{VZM|lK$Asoe-xN');
define('AUTH_SALT', 'Kt;N%htvDDP{DTICq]/NY);w!En/tD!ff||UpnD|aS[{j<lg+h+uUi=pV%P^e+wtpWFgmTsWO?La{OvU[?ng[t%hc^-hNAs%!v[oIG]v<p-Pp]s/F{?t-{ez>JnMSn(t');
define('SECURE_AUTH_SALT', '$yy^Id}&D=U[)WVtZ^&(p{(NqFj<{guetfb-?=na+A}oVoVMthjYwN$PA>/q%m]L+nITgb[irgC!Zje!LyR=a+L^-RNaD?;hV&e])u!IGUQ@YLxz@>t+Hj$?MwkQ-TX/');
define('LOGGED_IN_SALT', 'aVM$]X/}MjFp=OG(G!zHk>PpP=Gl[?XO-!zg!kL]FwDIDVfVWM/[W>Qc?AfYsa}Q[+EqjguS}[Z*(alBrDwxc;WA{S_rZ]O/ZaTo!;RE_Pbs-I&eIa&C@SQwn$ecewmN');
define('NONCE_SALT', 'fFfH<iLFR)NValG-EZ+PdnDmMo$u>(BHj^EZs-/tO_Ma^*(^RP|GEwqQPVMGR=Qc{nN!jhK]GDiT<v_ao[AAsVd%q@H%Zxx;{QU;J^+gf^r)koi>%hDOpw>NcSs>s-d(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_tyrp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
