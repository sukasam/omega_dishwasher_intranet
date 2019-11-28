-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2019 at 12:27 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omegadi1_intranet`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_schedule`
--

CREATE TABLE `service_schedule` (
  `id` int(11) NOT NULL,
  `month` int(2) NOT NULL,
  `year` varchar(4) DEFAULT NULL,
  `technician` int(11) NOT NULL,
  `sv_id` varchar(20) NOT NULL,
  `fo_id` varchar(20) NOT NULL,
  `pdf` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `s_approve`
--

CREATE TABLE `s_approve` (
  `id` int(11) NOT NULL,
  `tag_db` varchar(50) NOT NULL,
  `t_id` int(11) NOT NULL,
  `process_1` varchar(1) DEFAULT '0',
  `process_2` varchar(1) DEFAULT '0',
  `process_3` varchar(1) DEFAULT '0',
  `process_4` varchar(1) DEFAULT '0',
  `process_1_date` datetime DEFAULT NULL,
  `process_2_date` datetime DEFAULT NULL,
  `process_3_date` datetime DEFAULT NULL,
  `process_4_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_backup_database`
--

CREATE TABLE `s_backup_database` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_file` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_contract`
--

CREATE TABLE `s_contract` (
  `ct_id` int(14) UNSIGNED NOT NULL,
  `con_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `con_stime` date DEFAULT NULL,
  `con_startdate` date DEFAULT NULL,
  `con_enddate` date DEFAULT NULL,
  `con_paymonth` int(11) DEFAULT NULL,
  `con_chkpro` varchar(50) DEFAULT NULL,
  `con_chkprofree` varchar(50) DEFAULT NULL,
  `con_chktypepro` varchar(50) DEFAULT NULL,
  `con_img1` varchar(50) DEFAULT NULL,
  `csign` varchar(1) DEFAULT '0',
  `con_type_pro` varchar(10) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_contract2`
--

CREATE TABLE `s_contract2` (
  `ct_id` int(14) UNSIGNED NOT NULL,
  `con_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `con_stime` date DEFAULT NULL,
  `con_startdate` date DEFAULT NULL,
  `con_enddate` date DEFAULT NULL,
  `con_spar` varchar(1) DEFAULT '0',
  `con_price` int(11) DEFAULT NULL,
  `con_chkpro` varchar(50) DEFAULT NULL,
  `con_img1` varchar(50) DEFAULT NULL,
  `con_img2` varchar(50) DEFAULT NULL,
  `con_img3` varchar(50) DEFAULT NULL,
  `con_img4` varchar(50) DEFAULT NULL,
  `con_img5` varchar(50) DEFAULT NULL,
  `con_img6` varchar(50) DEFAULT NULL,
  `con_img7` varchar(50) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_contract3`
--

CREATE TABLE `s_contract3` (
  `ct_id` int(14) UNSIGNED NOT NULL,
  `con_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `con_stime` date DEFAULT NULL,
  `con_chkpro` varchar(50) DEFAULT NULL,
  `con_qatime` date DEFAULT NULL,
  `con_qap` varchar(2) DEFAULT NULL,
  `con_ortime` date DEFAULT NULL,
  `con_orp` varchar(2) DEFAULT NULL,
  `con_fines` varchar(10) DEFAULT NULL,
  `con_remainprice` varchar(20) DEFAULT NULL,
  `con_checknum` varchar(20) DEFAULT NULL,
  `con_checkmonth` varchar(50) DEFAULT NULL,
  `con_checkbank` varchar(50) DEFAULT NULL,
  `con_checkamount` varchar(20) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_document`
--

CREATE TABLE `s_document` (
  `id` int(10) UNSIGNED NOT NULL,
  `fo_id` int(11) DEFAULT NULL,
  `images` varchar(50) DEFAULT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `sorts` int(11) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_first_order`
--

CREATE TABLE `s_first_order` (
  `fo_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) DEFAULT NULL,
  `cd_address` varchar(255) DEFAULT NULL,
  `cd_province` varchar(11) DEFAULT '0',
  `cd_tel` varchar(50) DEFAULT NULL,
  `cd_fax` varchar(50) DEFAULT NULL,
  `cd_type` varchar(1) DEFAULT NULL,
  `name_consign` varchar(150) DEFAULT NULL,
  `cd_tax` varchar(50) DEFAULT NULL,
  `fs_id` varchar(20) DEFAULT NULL,
  `r_id` varchar(20) DEFAULT NULL,
  `date_forder` date DEFAULT NULL,
  `cg_type` varchar(11) DEFAULT '0',
  `ctype` varchar(11) DEFAULT '0',
  `pro_type` varchar(11) DEFAULT '0',
  `po_id` varchar(20) DEFAULT NULL,
  `pro_pod1` varchar(50) DEFAULT NULL,
  `pro_pod2` varchar(50) DEFAULT NULL,
  `pro_pod3` varchar(50) DEFAULT NULL,
  `pro_pod4` varchar(50) DEFAULT NULL,
  `pro_pod5` varchar(50) DEFAULT NULL,
  `pro_pod6` varchar(50) DEFAULT NULL,
  `pro_pod7` varchar(50) DEFAULT NULL,
  `pro_sn1` varchar(50) DEFAULT NULL,
  `pro_sn2` varchar(50) DEFAULT NULL,
  `pro_sn3` varchar(50) DEFAULT NULL,
  `pro_sn4` varchar(50) DEFAULT NULL,
  `pro_sn5` varchar(50) DEFAULT NULL,
  `pro_sn6` varchar(50) DEFAULT NULL,
  `pro_sn7` varchar(50) DEFAULT NULL,
  `c_contact` varchar(50) DEFAULT NULL,
  `c_tel` varchar(50) DEFAULT NULL,
  `loc_name` varchar(50) DEFAULT NULL,
  `loc_address` varchar(255) DEFAULT NULL,
  `loc_shopping` varchar(255) DEFAULT NULL,
  `loc_clean` varchar(100) DEFAULT NULL,
  `loc_clean_sn` varchar(50) DEFAULT NULL,
  `warter01` varchar(11) DEFAULT NULL,
  `warter02` varchar(11) DEFAULT NULL,
  `warter03` varchar(11) DEFAULT NULL,
  `warter04` varchar(11) DEFAULT NULL,
  `warter05` varchar(11) DEFAULT NULL,
  `warter06` varchar(11) DEFAULT NULL,
  `warter07` varchar(11) DEFAULT NULL,
  `cpro1` varchar(11) DEFAULT NULL,
  `cpro2` varchar(11) DEFAULT NULL,
  `cpro3` varchar(11) DEFAULT NULL,
  `cpro4` varchar(11) DEFAULT NULL,
  `cpro5` varchar(11) DEFAULT NULL,
  `cpro6` varchar(11) DEFAULT NULL,
  `cpro7` varchar(11) DEFAULT NULL,
  `camount1` varchar(11) DEFAULT NULL,
  `camount2` varchar(11) DEFAULT NULL,
  `camount3` varchar(11) DEFAULT NULL,
  `camount4` varchar(11) DEFAULT NULL,
  `camount5` varchar(11) DEFAULT NULL,
  `camount6` varchar(11) DEFAULT NULL,
  `camount7` varchar(11) DEFAULT NULL,
  `cprice1` varchar(20) DEFAULT NULL,
  `cprice2` varchar(20) DEFAULT NULL,
  `cprice3` varchar(20) DEFAULT NULL,
  `cprice4` varchar(20) DEFAULT NULL,
  `cprice5` varchar(20) DEFAULT NULL,
  `cprice6` varchar(20) DEFAULT NULL,
  `cprice7` varchar(20) DEFAULT NULL,
  `ccomment` text DEFAULT NULL,
  `cs_pro1` varchar(100) DEFAULT NULL,
  `cs_pro2` varchar(100) DEFAULT NULL,
  `cs_pro3` varchar(100) DEFAULT NULL,
  `cs_pro4` varchar(100) DEFAULT NULL,
  `cs_pro5` varchar(100) DEFAULT NULL,
  `cs_amount1` varchar(11) DEFAULT NULL,
  `cs_amount2` varchar(11) DEFAULT NULL,
  `cs_amount3` varchar(11) DEFAULT NULL,
  `cs_amount4` varchar(11) DEFAULT NULL,
  `cs_amount5` varchar(11) DEFAULT NULL,
  `cs_namecall1` varchar(20) DEFAULT NULL,
  `cs_namecall2` varchar(20) DEFAULT NULL,
  `cs_namecall3` varchar(20) DEFAULT NULL,
  `cs_namecall4` varchar(20) DEFAULT NULL,
  `cs_namecall5` varchar(20) DEFAULT NULL,
  `cs_sign` varchar(150) DEFAULT NULL,
  `date_quf` date DEFAULT NULL,
  `date_qut` date DEFAULT NULL,
  `qucomment` text DEFAULT NULL,
  `cs_contact` varchar(50) DEFAULT NULL,
  `cs_tel` varchar(50) DEFAULT NULL,
  `cs_ship` date DEFAULT NULL,
  `cs_company` varchar(50) DEFAULT NULL,
  `cs_setting` date DEFAULT NULL,
  `cs_sell` varchar(50) DEFAULT NULL,
  `cs_hsell` varchar(50) DEFAULT NULL,
  `cs_account` varchar(50) DEFAULT NULL,
  `cs_aceep` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `st_setting` varchar(11) DEFAULT '0',
  `separate` varchar(1) DEFAULT '0',
  `cusid` varchar(25) DEFAULT NULL,
  `money_garuntree` varchar(10) DEFAULT '0',
  `money_setup` varchar(10) DEFAULT '0',
  `typegaruntree` varchar(1) DEFAULT NULL,
  `notvat1` varchar(1) DEFAULT NULL,
  `notvat2` varchar(1) DEFAULT NULL,
  `status_use` varchar(11) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `technic_service` varchar(11) DEFAULT NULL,
  `type_service` varchar(11) DEFAULT NULL,
  `process` varchar(1) DEFAULT '0',
  `chkprocess` varchar(1) DEFAULT '0',
  `google_map` text DEFAULT NULL,
  `prowithliquid` varchar(10) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group`
--

CREATE TABLE `s_group` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_approve`
--

CREATE TABLE `s_group_approve` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `user_account` varchar(10) DEFAULT '0',
  `group_position` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_contract`
--

CREATE TABLE `s_group_contract` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_con_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_custommer`
--

CREATE TABLE `s_group_custommer` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_cus_code` varchar(20) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_fix`
--

CREATE TABLE `s_group_fix` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_fix_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_pod`
--

CREATE TABLE `s_group_pod` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spro_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_stock` int(14) DEFAULT NULL,
  `group_pro_pod` varchar(50) NOT NULL,
  `group_pro_sn` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_product`
--

CREATE TABLE `s_group_product` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_pro_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sale`
--

CREATE TABLE `s_group_sale` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_tel` varchar(50) NOT NULL,
  `approve` varchar(1) DEFAULT '0',
  `user_account` varchar(10) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_service`
--

CREATE TABLE `s_group_service` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_ser_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sn`
--

CREATE TABLE `s_group_sn` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_product` varchar(10) DEFAULT NULL,
  `group_pod` varchar(255) DEFAULT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_datetime_key` date DEFAULT NULL,
  `group_shipnumber` varchar(50) DEFAULT NULL,
  `group_invoicenumber` varchar(50) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart`
--

CREATE TABLE `s_group_sparpart` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spar_id` varchar(20) NOT NULL,
  `group_spar_code` varchar(20) DEFAULT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_location` varchar(50) DEFAULT NULL,
  `group_stock` int(14) DEFAULT 0,
  `group_unit_price` varchar(20) DEFAULT NULL,
  `group_namecall` varchar(100) NOT NULL,
  `group_type` varchar(50) DEFAULT NULL,
  `group_price` varchar(20) NOT NULL,
  `typespar` varchar(1) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart_bill`
--

CREATE TABLE `s_group_sparpart_bill` (
  `sub_id` int(11) NOT NULL,
  `sub_name` text DEFAULT NULL,
  `sub_address` text DEFAULT NULL,
  `sub_tel` text DEFAULT NULL,
  `sub_billnum` varchar(50) DEFAULT NULL,
  `sub_billdate` date DEFAULT NULL,
  `sub_comment` text DEFAULT NULL,
  `sub_vat` varchar(1) DEFAULT NULL,
  `stock_date` date DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_sparpart_bill_pro`
--

CREATE TABLE `s_group_sparpart_bill_pro` (
  `id` int(11) NOT NULL,
  `id_bill` int(15) NOT NULL,
  `sparpart_id` varchar(20) NOT NULL,
  `sparpart_qty` int(15) NOT NULL,
  `sparpart_unit_price` varchar(20) NOT NULL,
  `sparpart_total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_technician`
--

CREATE TABLE `s_group_technician` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_cus_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_tel` varchar(50) NOT NULL,
  `user_account` varchar(10) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_type`
--

CREATE TABLE `s_group_type` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_type_id` varchar(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_typeproduct`
--

CREATE TABLE `s_group_typeproduct` (
  `group_id` int(14) UNSIGNED NOT NULL,
  `group_spro_id` varchar(20) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `group_detail` text DEFAULT NULL,
  `group_stock` int(14) DEFAULT 0,
  `group_pro_pod` varchar(50) DEFAULT NULL,
  `group_pro_sn` varchar(50) DEFAULT NULL,
  `group_namecall` varchar(50) DEFAULT NULL,
  `group_unit_price` varchar(20) DEFAULT '0',
  `group_price` varchar(20) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_typeproduct_bill`
--

CREATE TABLE `s_group_typeproduct_bill` (
  `sub_id` int(11) NOT NULL,
  `sub_name` text DEFAULT NULL,
  `sub_address` text DEFAULT NULL,
  `sub_tel` text DEFAULT NULL,
  `sub_billnum` varchar(50) DEFAULT NULL,
  `sub_billdate` date DEFAULT NULL,
  `sub_comment` text DEFAULT NULL,
  `sub_vat` varchar(1) DEFAULT NULL,
  `stock_date` date DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_group_typeproduct_bill_pro`
--

CREATE TABLE `s_group_typeproduct_bill_pro` (
  `id` int(11) NOT NULL,
  `id_bill` int(15) NOT NULL,
  `sparpart_id` varchar(20) NOT NULL,
  `sparpart_pod` varchar(50) DEFAULT NULL,
  `sparpart_qty` int(15) NOT NULL,
  `sparpart_unit_price` varchar(20) NOT NULL,
  `sparpart_total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_lang`
--

CREATE TABLE `s_lang` (
  `lang_id` bigint(20) NOT NULL,
  `lang_name` varchar(100) NOT NULL,
  `lang_key` varchar(50) NOT NULL,
  `lang_images` varchar(255) NOT NULL,
  `lang_status` int(2) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_memo`
--

CREATE TABLE `s_memo` (
  `id` int(14) UNSIGNED NOT NULL,
  `mo_id` varchar(50) NOT NULL,
  `fo_id` int(10) NOT NULL,
  `memo_open` date DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `dear` text DEFAULT NULL,
  `remark1` text DEFAULT NULL,
  `remark2` text DEFAULT NULL,
  `remark3` text DEFAULT NULL,
  `remark4` text DEFAULT NULL,
  `cs_sell` varchar(150) DEFAULT NULL,
  `cs_hsell` varchar(150) DEFAULT NULL,
  `cs_aceep` varchar(150) DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `date_hsell` date DEFAULT NULL,
  `date_accep` date DEFAULT NULL,
  `st_setting` varchar(1) DEFAULT '0',
  `process` int(1) DEFAULT 0,
  `con_chkpro` text DEFAULT NULL,
  `con_chkprofree` text DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_module`
--

CREATE TABLE `s_module` (
  `module_id` bigint(20) NOT NULL,
  `module_name` varchar(50) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_province`
--

CREATE TABLE `s_province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_quotation`
--

CREATE TABLE `s_quotation` (
  `qu_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) NOT NULL,
  `cd_address` varchar(255) NOT NULL,
  `cd_province` int(11) NOT NULL,
  `cd_tel` varchar(50) NOT NULL,
  `cd_fax` varchar(50) NOT NULL,
  `fs_id` varchar(20) NOT NULL,
  `date_forder` date NOT NULL,
  `pro_type` int(11) NOT NULL,
  `pro_pod1` varchar(50) DEFAULT NULL,
  `pro_pod2` varchar(50) DEFAULT NULL,
  `pro_pod3` varchar(50) DEFAULT NULL,
  `pro_pod4` varchar(50) DEFAULT NULL,
  `pro_pod5` varchar(50) DEFAULT NULL,
  `pro_pod6` varchar(50) DEFAULT NULL,
  `pro_pod7` varchar(50) DEFAULT NULL,
  `pro_sn1` varchar(50) NOT NULL,
  `pro_sn2` varchar(50) NOT NULL,
  `pro_sn3` varchar(50) NOT NULL,
  `pro_sn4` varchar(50) NOT NULL,
  `pro_sn5` varchar(50) NOT NULL,
  `pro_sn6` varchar(50) NOT NULL,
  `pro_sn7` varchar(50) NOT NULL,
  `c_contact` varchar(50) NOT NULL,
  `c_tel` varchar(50) NOT NULL,
  `cpro1` varchar(11) NOT NULL,
  `cpro2` varchar(11) NOT NULL,
  `cpro3` varchar(11) NOT NULL,
  `cpro4` varchar(11) NOT NULL,
  `cpro5` varchar(11) NOT NULL,
  `cpro6` varchar(11) NOT NULL,
  `cpro7` varchar(11) NOT NULL,
  `camount1` varchar(11) NOT NULL,
  `camount2` varchar(11) NOT NULL,
  `camount3` varchar(11) NOT NULL,
  `camount4` varchar(11) NOT NULL,
  `camount5` varchar(11) NOT NULL,
  `camount6` varchar(11) NOT NULL,
  `camount7` varchar(11) NOT NULL,
  `cprice1` varchar(20) NOT NULL,
  `cprice2` varchar(20) NOT NULL,
  `cprice3` varchar(20) NOT NULL,
  `cprice4` varchar(20) NOT NULL,
  `cprice5` varchar(20) NOT NULL,
  `cprice6` varchar(20) NOT NULL,
  `cprice7` varchar(20) NOT NULL,
  `cs_pro1` varchar(100) NOT NULL,
  `cs_pro2` varchar(100) NOT NULL,
  `cs_pro3` varchar(100) NOT NULL,
  `cs_pro4` varchar(100) NOT NULL,
  `cs_pro5` varchar(100) NOT NULL,
  `cs_amount1` varchar(11) NOT NULL,
  `cs_amount2` varchar(11) NOT NULL,
  `cs_amount3` varchar(11) NOT NULL,
  `cs_amount4` varchar(11) NOT NULL,
  `cs_amount5` varchar(11) NOT NULL,
  `cs_sell` varchar(50) NOT NULL,
  `cs_hsell` varchar(50) NOT NULL,
  `cs_account` varchar(50) NOT NULL,
  `remark` text NOT NULL,
  `st_setting` int(11) NOT NULL,
  `type_service` int(11) NOT NULL,
  `payc` varchar(1) DEFAULT NULL,
  `paym` varchar(20) DEFAULT NULL,
  `paym2` varchar(20) DEFAULT NULL,
  `paym3` varchar(20) DEFAULT NULL,
  `pay_apv` date DEFAULT '0000-00-00',
  `pays` varchar(2) DEFAULT NULL,
  `paysa` varchar(20) DEFAULT NULL,
  `paysad` varchar(10) DEFAULT NULL,
  `type_electric` varchar(200) DEFAULT NULL,
  `giveprice` varchar(10) DEFAULT NULL,
  `guaran1` varchar(50) DEFAULT NULL,
  `guaran2` varchar(50) DEFAULT NULL,
  `guaran3` varchar(50) DEFAULT NULL,
  `guaran4` varchar(50) DEFAULT NULL,
  `date_sell` date NOT NULL,
  `date_hsell` date NOT NULL,
  `date_account` date NOT NULL,
  `tel_sell` varchar(50) DEFAULT NULL,
  `tel_hsell` varchar(50) DEFAULT NULL,
  `tel_account` varchar(50) DEFAULT NULL,
  `quotation` varchar(50) DEFAULT NULL,
  `process` varchar(1) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_quotation2`
--

CREATE TABLE `s_quotation2` (
  `qu_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) NOT NULL,
  `cd_address` varchar(255) NOT NULL,
  `cd_province` int(11) NOT NULL,
  `cd_tel` varchar(50) NOT NULL,
  `cd_fax` varchar(50) NOT NULL,
  `fs_id` varchar(20) NOT NULL,
  `date_forder` date NOT NULL,
  `pro_type` int(11) NOT NULL,
  `pro_pod1` varchar(50) DEFAULT NULL,
  `pro_pod2` varchar(50) DEFAULT NULL,
  `pro_pod3` varchar(50) DEFAULT NULL,
  `pro_pod4` varchar(50) DEFAULT NULL,
  `pro_pod5` varchar(50) DEFAULT NULL,
  `pro_pod6` varchar(50) DEFAULT NULL,
  `pro_pod7` varchar(50) DEFAULT NULL,
  `pro_sn1` varchar(50) NOT NULL,
  `pro_sn2` varchar(50) NOT NULL,
  `pro_sn3` varchar(50) NOT NULL,
  `pro_sn4` varchar(50) NOT NULL,
  `pro_sn5` varchar(50) NOT NULL,
  `pro_sn6` varchar(50) NOT NULL,
  `pro_sn7` varchar(50) NOT NULL,
  `c_contact` varchar(50) NOT NULL,
  `c_tel` varchar(50) NOT NULL,
  `cpro1` varchar(11) NOT NULL,
  `cpro2` varchar(11) NOT NULL,
  `cpro3` varchar(11) NOT NULL,
  `cpro4` varchar(11) NOT NULL,
  `cpro5` varchar(11) NOT NULL,
  `cpro6` varchar(11) NOT NULL,
  `cpro7` varchar(11) NOT NULL,
  `camount1` varchar(11) NOT NULL,
  `camount2` varchar(11) NOT NULL,
  `camount3` varchar(11) NOT NULL,
  `camount4` varchar(11) NOT NULL,
  `camount5` varchar(11) NOT NULL,
  `camount6` varchar(11) NOT NULL,
  `camount7` varchar(11) NOT NULL,
  `cprice1` varchar(20) NOT NULL,
  `cprice2` varchar(20) NOT NULL,
  `cprice3` varchar(20) NOT NULL,
  `cprice4` varchar(20) NOT NULL,
  `cprice5` varchar(20) NOT NULL,
  `cprice6` varchar(20) NOT NULL,
  `cprice7` varchar(20) NOT NULL,
  `cs_pro1` varchar(100) NOT NULL,
  `cs_pro2` varchar(100) NOT NULL,
  `cs_pro3` varchar(100) NOT NULL,
  `cs_pro4` varchar(100) NOT NULL,
  `cs_pro5` varchar(100) NOT NULL,
  `cs_amount1` varchar(11) NOT NULL,
  `cs_amount2` varchar(11) NOT NULL,
  `cs_amount3` varchar(11) NOT NULL,
  `cs_amount4` varchar(11) NOT NULL,
  `cs_amount5` varchar(11) NOT NULL,
  `cs_sell` varchar(50) NOT NULL,
  `cs_hsell` varchar(50) NOT NULL,
  `cs_account` varchar(50) NOT NULL,
  `spro1` text DEFAULT NULL,
  `spro2` text DEFAULT NULL,
  `sqty1` varchar(10) DEFAULT NULL,
  `sqty2` varchar(10) DEFAULT NULL,
  `sprice1` varchar(10) DEFAULT NULL,
  `sprice2` varchar(10) DEFAULT NULL,
  `sdisc1` varchar(10) DEFAULT NULL,
  `sdisc2` varchar(10) DEFAULT NULL,
  `remark` text NOT NULL,
  `st_setting` int(11) NOT NULL,
  `type_service` int(11) NOT NULL,
  `payc` varchar(1) DEFAULT NULL,
  `paym` varchar(20) DEFAULT NULL,
  `pay_apv` date DEFAULT NULL,
  `pays` varchar(2) DEFAULT NULL,
  `paysa` varchar(20) DEFAULT NULL,
  `paysad` varchar(10) DEFAULT NULL,
  `type_electric` varchar(200) DEFAULT NULL,
  `giveprice` varchar(10) DEFAULT NULL,
  `guaran2` varchar(50) DEFAULT NULL,
  `date_sell` date NOT NULL,
  `date_hsell` date NOT NULL,
  `date_account` date NOT NULL,
  `tel_sell` varchar(50) DEFAULT NULL,
  `tel_hsell` varchar(50) DEFAULT NULL,
  `tel_account` varchar(50) DEFAULT NULL,
  `quotation` varchar(50) DEFAULT NULL,
  `process` varchar(1) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_quotation3`
--

CREATE TABLE `s_quotation3` (
  `qu_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) DEFAULT NULL,
  `cd_address` varchar(255) DEFAULT NULL,
  `cd_province` int(11) DEFAULT NULL,
  `cd_tel` varchar(50) DEFAULT NULL,
  `cd_fax` varchar(50) DEFAULT NULL,
  `fs_id` varchar(20) DEFAULT NULL,
  `date_forder` date DEFAULT NULL,
  `type_service` varchar(1) DEFAULT '0',
  `pro_pod1` varchar(50) DEFAULT NULL,
  `pro_pod2` varchar(50) DEFAULT NULL,
  `pro_pod3` varchar(50) DEFAULT NULL,
  `pro_pod4` varchar(50) DEFAULT NULL,
  `pro_pod5` varchar(50) DEFAULT NULL,
  `pro_pod6` varchar(50) DEFAULT NULL,
  `pro_pod7` varchar(50) DEFAULT NULL,
  `pro_sn1` varchar(50) DEFAULT NULL,
  `pro_sn2` varchar(50) DEFAULT NULL,
  `pro_sn3` varchar(50) DEFAULT NULL,
  `pro_sn4` varchar(50) DEFAULT NULL,
  `pro_sn5` varchar(50) DEFAULT NULL,
  `pro_sn6` varchar(50) DEFAULT NULL,
  `pro_sn7` varchar(50) DEFAULT NULL,
  `c_contact` varchar(50) DEFAULT NULL,
  `c_tel` varchar(50) DEFAULT NULL,
  `cpro1` varchar(11) DEFAULT NULL,
  `cpro2` varchar(11) DEFAULT NULL,
  `cpro3` varchar(11) DEFAULT NULL,
  `cpro4` varchar(11) DEFAULT NULL,
  `cpro5` varchar(11) DEFAULT NULL,
  `cpro6` varchar(11) DEFAULT NULL,
  `cpro7` varchar(11) DEFAULT NULL,
  `camount1` varchar(11) DEFAULT NULL,
  `camount2` varchar(11) DEFAULT NULL,
  `camount3` varchar(11) DEFAULT NULL,
  `camount4` varchar(11) DEFAULT NULL,
  `camount5` varchar(11) DEFAULT NULL,
  `camount6` varchar(11) DEFAULT NULL,
  `camount7` varchar(11) DEFAULT NULL,
  `cprice1` varchar(20) DEFAULT NULL,
  `cprice2` varchar(20) DEFAULT NULL,
  `cprice3` varchar(20) DEFAULT NULL,
  `cprice4` varchar(20) DEFAULT NULL,
  `cprice5` varchar(20) DEFAULT NULL,
  `cprice6` varchar(20) DEFAULT NULL,
  `cprice7` varchar(20) DEFAULT NULL,
  `cs_technic` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `st_setting` int(11) DEFAULT 0,
  `giveprice` varchar(10) DEFAULT NULL,
  `guaran` varchar(10) DEFAULT NULL,
  `quotation` varchar(50) DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_quotation4`
--

CREATE TABLE `s_quotation4` (
  `qu_id` int(14) UNSIGNED NOT NULL,
  `cd_name` varchar(255) DEFAULT NULL,
  `cd_address` varchar(255) DEFAULT NULL,
  `cd_province` int(11) DEFAULT NULL,
  `cd_tel` varchar(50) DEFAULT NULL,
  `cd_fax` varchar(50) DEFAULT NULL,
  `fs_id` varchar(20) DEFAULT NULL,
  `date_forder` date DEFAULT NULL,
  `type_service` varchar(1) DEFAULT '0',
  `pro_pod1` varchar(50) DEFAULT NULL,
  `pro_pod2` varchar(50) DEFAULT NULL,
  `pro_sn1` varchar(50) DEFAULT NULL,
  `pro_sn2` varchar(50) DEFAULT NULL,
  `c_contact` varchar(50) DEFAULT NULL,
  `c_tel` varchar(50) DEFAULT NULL,
  `cpro1` text DEFAULT NULL,
  `cpro2` text DEFAULT NULL,
  `camount1` varchar(11) DEFAULT NULL,
  `camount2` varchar(11) DEFAULT NULL,
  `camount7` varchar(11) DEFAULT NULL,
  `cprice1` varchar(20) DEFAULT NULL,
  `cprice2` varchar(20) DEFAULT NULL,
  `cs_technic` varchar(50) DEFAULT NULL,
  `remark` text DEFAULT NULL,
  `st_setting` int(11) DEFAULT 0,
  `giveprice` varchar(10) DEFAULT NULL,
  `guaran` varchar(10) DEFAULT NULL,
  `quotation` varchar(50) DEFAULT NULL,
  `chkserv1` varchar(1) DEFAULT '0',
  `chkserv2` varchar(1) DEFAULT '0',
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `s_quotation_jobcard`
--

CREATE TABLE `s_quotation_jobcard` (
  `qc_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `qu_id` varchar(20) NOT NULL,
  `qu_table` varchar(1) NOT NULL,
  `job_open` date NOT NULL,
  `st_setting` varchar(11) NOT NULL,
  `type_service` varchar(1) DEFAULT NULL,
  `ser_pro1` varchar(200) DEFAULT NULL,
  `ser_pro2` varchar(200) DEFAULT NULL,
  `ser_pro3` varchar(200) DEFAULT NULL,
  `ser_pro4` text DEFAULT NULL,
  `ser_pro5` text DEFAULT NULL,
  `ser_pro6` varchar(200) DEFAULT NULL,
  `ser_pro7` varchar(200) DEFAULT NULL,
  `ser_sn1` varchar(200) DEFAULT NULL,
  `ser_sn2` varchar(200) DEFAULT NULL,
  `ser_sn3` varchar(200) DEFAULT NULL,
  `ser_sn4` varchar(200) DEFAULT NULL,
  `ser_sn5` varchar(200) DEFAULT NULL,
  `date_appoint1` date DEFAULT NULL,
  `date_appoint2` date DEFAULT NULL,
  `date_appoint3` date DEFAULT NULL,
  `date_appoint4` date DEFAULT NULL,
  `date_appoint5` date DEFAULT NULL,
  `date_appoint6` date DEFAULT NULL,
  `date_appoint7` date NOT NULL,
  `detail_recom` text DEFAULT NULL,
  `cs_sell` varchar(50) DEFAULT NULL,
  `cs_hsell` varchar(50) DEFAULT NULL,
  `cs_providers` varchar(50) DEFAULT NULL,
  `tel_sell` varchar(50) DEFAULT NULL,
  `tel_hsell` varchar(50) DEFAULT NULL,
  `tel_providers` varchar(50) DEFAULT NULL,
  `date_sell` date DEFAULT NULL,
  `date_hsell` date DEFAULT NULL,
  `date_providers` date DEFAULT NULL,
  `process` int(1) DEFAULT 0,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_cost`
--

CREATE TABLE `s_service_cost` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `setup` varchar(20) DEFAULT NULL,
  `ot` varchar(20) DEFAULT NULL,
  `ot_1` varchar(20) DEFAULT NULL,
  `pd` varchar(20) DEFAULT NULL,
  `ot_person` varchar(20) DEFAULT NULL,
  `ot_day` varchar(20) DEFAULT NULL,
  `travel` varchar(100) DEFAULT NULL,
  `distance` varchar(50) DEFAULT NULL,
  `detail1` varchar(20) DEFAULT NULL,
  `detail2` varchar(50) DEFAULT NULL,
  `detail3` varchar(20) DEFAULT NULL,
  `detail3_1` varchar(20) DEFAULT NULL,
  `detail4` varchar(20) DEFAULT NULL,
  `detail5` varchar(20) DEFAULT NULL,
  `detail6` varchar(20) DEFAULT NULL,
  `detail7` varchar(20) DEFAULT NULL,
  `detail8` varchar(20) DEFAULT NULL,
  `detail9` varchar(20) DEFAULT NULL,
  `technician1` int(11) DEFAULT NULL,
  `technician2` int(11) DEFAULT NULL,
  `technician3` int(11) DEFAULT NULL,
  `technician4` int(11) DEFAULT NULL,
  `technician5` int(11) DEFAULT NULL,
  `technician6` int(11) DEFAULT NULL,
  `technician7` int(11) DEFAULT NULL,
  `technician8` int(11) DEFAULT NULL,
  `cost_other1` varchar(20) DEFAULT NULL,
  `cost_other2` varchar(20) DEFAULT NULL,
  `cost_other3` varchar(20) DEFAULT NULL,
  `cost_other4` varchar(20) DEFAULT NULL,
  `cost_other5` varchar(20) DEFAULT NULL,
  `cost_other6` varchar(20) DEFAULT NULL,
  `cost_other7` varchar(20) DEFAULT NULL,
  `cost_other8` varchar(20) DEFAULT NULL,
  `cost_other9` varchar(20) DEFAULT NULL,
  `cost_other10` varchar(20) DEFAULT NULL,
  `cost_other11` varchar(20) DEFAULT NULL,
  `cost_other12` varchar(20) DEFAULT NULL,
  `cost_other13` varchar(20) DEFAULT NULL,
  `cost_other14` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report`
--

CREATE TABLE `s_service_report` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `srid` varchar(20) DEFAULT '',
  `cus_id` int(11) NOT NULL,
  `sr_ctype` varchar(10) DEFAULT NULL,
  `sr_ctype2` varchar(10) DEFAULT NULL,
  `job_open` date DEFAULT NULL,
  `job_close` date DEFAULT NULL,
  `job_balance` date DEFAULT NULL,
  `sr_stime` date DEFAULT NULL,
  `loc_pro` varchar(50) DEFAULT NULL,
  `loc_seal` varchar(50) DEFAULT NULL,
  `loc_sn` varchar(50) DEFAULT NULL,
  `loc_clean` varchar(50) DEFAULT NULL,
  `loc_clean_sn` varchar(50) DEFAULT NULL,
  `loc_contact` varchar(50) DEFAULT NULL,
  `loc_tels` varchar(50) DEFAULT NULL,
  `cl_01` varchar(50) DEFAULT NULL,
  `cl_02` varchar(50) DEFAULT NULL,
  `cl_03` varchar(50) DEFAULT NULL,
  `cl_04` varchar(50) DEFAULT NULL,
  `cl_05` varchar(50) DEFAULT NULL,
  `cl_06` varchar(50) DEFAULT NULL,
  `cl_07` varchar(50) DEFAULT NULL,
  `cl_08` varchar(50) DEFAULT NULL,
  `ckl_list` varchar(50) DEFAULT NULL,
  `ckw_list` varchar(50) DEFAULT NULL,
  `ckf_list` varchar(50) DEFAULT NULL,
  `detail_recom` text DEFAULT NULL,
  `detail_recom2` text DEFAULT NULL,
  `detail_calpr` text DEFAULT NULL,
  `cpro1` varchar(11) DEFAULT NULL,
  `cpro2` varchar(11) DEFAULT NULL,
  `cpro3` varchar(11) DEFAULT NULL,
  `cpro4` varchar(11) DEFAULT NULL,
  `cpro5` varchar(11) DEFAULT NULL,
  `camount1` varchar(10) DEFAULT NULL,
  `camount2` varchar(10) DEFAULT NULL,
  `camount3` varchar(10) DEFAULT NULL,
  `camount4` varchar(10) DEFAULT NULL,
  `camount5` varchar(10) DEFAULT NULL,
  `cprice1` varchar(20) DEFAULT NULL,
  `cprice2` varchar(20) DEFAULT NULL,
  `cprice3` varchar(20) DEFAULT NULL,
  `cprice4` varchar(20) DEFAULT NULL,
  `cprice5` varchar(20) DEFAULT NULL,
  `approve` varchar(1) DEFAULT '0',
  `supply` varchar(1) DEFAULT '0',
  `st_setting` varchar(11) DEFAULT '0',
  `process` varchar(1) DEFAULT '0',
  `signature` varchar(50) DEFAULT NULL,
  `signature_date` datetime DEFAULT current_timestamp(),
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `service_image` text DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report2`
--

CREATE TABLE `s_service_report2` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) DEFAULT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `srid` varchar(20) DEFAULT NULL,
  `srid2` varchar(20) DEFAULT NULL,
  `sr_ctype` varchar(10) DEFAULT NULL,
  `sr_ctype2` varchar(10) DEFAULT NULL,
  `job_open` date DEFAULT NULL,
  `job_close` date DEFAULT NULL,
  `job_balance` date DEFAULT NULL,
  `sr_stime` date DEFAULT NULL,
  `loc_pro` varchar(50) DEFAULT NULL,
  `loc_seal` varchar(50) DEFAULT NULL,
  `loc_sn` varchar(50) DEFAULT NULL,
  `loc_clean` varchar(50) DEFAULT NULL,
  `loc_contact` varchar(50) DEFAULT NULL,
  `loc_contact2` int(11) DEFAULT NULL,
  `loc_contact3` int(11) DEFAULT NULL,
  `cs_sell` int(11) DEFAULT NULL,
  `loc_tels` varchar(50) DEFAULT NULL,
  `cl_01` varchar(50) DEFAULT NULL,
  `cl_02` varchar(50) DEFAULT NULL,
  `cl_03` varchar(50) DEFAULT NULL,
  `cl_04` varchar(50) DEFAULT NULL,
  `cl_05` varchar(50) DEFAULT NULL,
  `cl_06` varchar(50) DEFAULT NULL,
  `cl_07` varchar(50) DEFAULT NULL,
  `cl_08` varchar(50) DEFAULT NULL,
  `ckl_list` varchar(50) DEFAULT NULL,
  `ckw_list` varchar(50) DEFAULT NULL,
  `ckf_list` varchar(50) DEFAULT NULL,
  `detail_recom` text DEFAULT NULL,
  `detail_recom2` text DEFAULT NULL,
  `detail_calpr` text DEFAULT NULL,
  `approve` int(1) DEFAULT 0,
  `supply` int(1) DEFAULT NULL,
  `st_setting` int(11) DEFAULT NULL,
  `loc_date2` date DEFAULT NULL,
  `sell_date` date DEFAULT NULL,
  `loc_date3` date DEFAULT NULL,
  `ref_date` date DEFAULT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report2sub`
--

CREATE TABLE `s_service_report2sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) DEFAULT NULL,
  `codes` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `lists` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `units` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `prices` varchar(20) DEFAULT NULL,
  `amounts` varchar(20) DEFAULT NULL,
  `opens` varchar(20) DEFAULT NULL,
  `remains` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report3`
--

CREATE TABLE `s_service_report3` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `srid` varchar(20) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` int(11) NOT NULL,
  `loc_contact3` int(11) NOT NULL,
  `cs_sell` int(11) NOT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `approve_return` int(1) NOT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report3sub`
--

CREATE TABLE `s_service_report3sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) NOT NULL,
  `lists` varchar(255) NOT NULL,
  `units` varchar(20) NOT NULL,
  `prices` varchar(20) DEFAULT '0',
  `amounts` varchar(20) DEFAULT '0',
  `opens` varchar(20) DEFAULT '0',
  `remains` varchar(20) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report4`
--

CREATE TABLE `s_service_report4` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `srid` varchar(20) NOT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` int(11) NOT NULL,
  `loc_contact3` int(11) NOT NULL,
  `cs_sell` int(11) NOT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `mn_1` int(11) NOT NULL,
  `mn_2` int(11) NOT NULL,
  `mn_3` int(11) NOT NULL,
  `mn_4` int(11) NOT NULL,
  `mn_5` int(11) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `u_images` varchar(50) NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` date NOT NULL,
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report4sub`
--

CREATE TABLE `s_service_report4sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) NOT NULL,
  `lists` varchar(255) NOT NULL,
  `units` varchar(20) NOT NULL,
  `prices` float NOT NULL,
  `amounts` float NOT NULL,
  `opens` float NOT NULL,
  `remains` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report5`
--

CREATE TABLE `s_service_report5` (
  `sr_id` int(14) UNSIGNED NOT NULL,
  `sv_id` varchar(50) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `srid` varchar(20) DEFAULT NULL,
  `sr_ctype` varchar(10) NOT NULL,
  `sr_ctype2` varchar(10) NOT NULL,
  `job_open` date NOT NULL,
  `job_close` date NOT NULL,
  `job_balance` date NOT NULL,
  `sr_stime` date NOT NULL,
  `loc_pro` varchar(50) NOT NULL,
  `loc_seal` varchar(50) NOT NULL,
  `loc_sn` varchar(50) NOT NULL,
  `loc_clean` varchar(50) NOT NULL,
  `loc_contact` varchar(50) NOT NULL,
  `loc_contact2` int(11) NOT NULL,
  `loc_contact3` int(11) NOT NULL,
  `cs_sell` int(11) NOT NULL,
  `loc_tels` varchar(50) NOT NULL,
  `cl_01` varchar(50) NOT NULL,
  `cl_02` varchar(50) NOT NULL,
  `cl_03` varchar(50) NOT NULL,
  `cl_04` varchar(50) NOT NULL,
  `cl_05` varchar(50) NOT NULL,
  `cl_06` varchar(50) NOT NULL,
  `cl_07` varchar(50) NOT NULL,
  `cl_08` varchar(50) NOT NULL,
  `ckl_list` varchar(50) NOT NULL,
  `ckw_list` varchar(50) NOT NULL,
  `ckf_list` varchar(50) NOT NULL,
  `detail_recom` text NOT NULL,
  `detail_recom2` text NOT NULL,
  `detail_calpr` text NOT NULL,
  `approve` int(1) NOT NULL,
  `supply` int(1) NOT NULL,
  `approve_return` int(1) NOT NULL,
  `st_setting` int(11) NOT NULL,
  `loc_date2` date NOT NULL,
  `sell_date` date NOT NULL,
  `loc_date3` date NOT NULL,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_service_report5sub`
--

CREATE TABLE `s_service_report5sub` (
  `r_id` int(11) NOT NULL,
  `sr_id` int(11) NOT NULL,
  `codes` varchar(20) DEFAULT NULL,
  `lists` varchar(255) DEFAULT NULL,
  `units` varchar(20) DEFAULT NULL,
  `prices` varchar(20) DEFAULT NULL,
  `amounts` varchar(20) DEFAULT NULL,
  `opens` varchar(20) DEFAULT NULL,
  `remains` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_signature`
--

CREATE TABLE `s_signature` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Draw` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user`
--

CREATE TABLE `s_user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `u_images` varchar(255) DEFAULT NULL,
  `admin_flag` int(2) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `create_date` datetime DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user_group`
--

CREATE TABLE `s_user_group` (
  `user_group_id` int(10) UNSIGNED NOT NULL,
  `user_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `group_id` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `create_by` varchar(100) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(100) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(100) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `s_user_p`
--

CREATE TABLE `s_user_p` (
  `user_p_id` bigint(20) NOT NULL,
  `user_id` varchar(3) NOT NULL,
  `group_id` varchar(3) DEFAULT NULL,
  `module_id` varchar(3) NOT NULL,
  `read_p` char(1) DEFAULT '0',
  `add_p` char(1) DEFAULT '0',
  `update_p` char(1) DEFAULT '0',
  `delete_p` char(1) DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_by` varchar(50) DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_by` varchar(50) DEFAULT NULL,
  `delete_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_by` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_cate`
--

CREATE TABLE `tb_menu_cate` (
  `menucate_id` int(10) UNSIGNED NOT NULL,
  `rank` int(10) NOT NULL,
  `menucate_name` varchar(255) NOT NULL,
  `url_link` varchar(255) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(100) NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_by` varchar(100) NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu_submenu`
--

CREATE TABLE `tb_menu_submenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `rank` int(10) NOT NULL,
  `menucate_id` int(10) NOT NULL,
  `submenu_name` varchar(255) NOT NULL,
  `submenu_url_link` varchar(255) NOT NULL,
  `create_by` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_by` varchar(100) NOT NULL,
  `update_date` datetime NOT NULL,
  `delete_by` varchar(100) NOT NULL,
  `delete_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_schedule`
--
ALTER TABLE `service_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_approve`
--
ALTER TABLE `s_approve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_backup_database`
--
ALTER TABLE `s_backup_database`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_contract`
--
ALTER TABLE `s_contract`
  ADD PRIMARY KEY (`ct_id`),
  ADD UNIQUE KEY `con_id` (`con_id`);

--
-- Indexes for table `s_contract2`
--
ALTER TABLE `s_contract2`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `s_contract3`
--
ALTER TABLE `s_contract3`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `s_document`
--
ALTER TABLE `s_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_first_order`
--
ALTER TABLE `s_first_order`
  ADD PRIMARY KEY (`fo_id`),
  ADD UNIQUE KEY `fs_id` (`fs_id`);

--
-- Indexes for table `s_group`
--
ALTER TABLE `s_group`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_approve`
--
ALTER TABLE `s_group_approve`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_contract`
--
ALTER TABLE `s_group_contract`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`),
  ADD UNIQUE KEY `group_con_id` (`group_con_id`);

--
-- Indexes for table `s_group_custommer`
--
ALTER TABLE `s_group_custommer`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_fix`
--
ALTER TABLE `s_group_fix`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_pod`
--
ALTER TABLE `s_group_pod`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_product`
--
ALTER TABLE `s_group_product`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sale`
--
ALTER TABLE `s_group_sale`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_service`
--
ALTER TABLE `s_group_service`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sn`
--
ALTER TABLE `s_group_sn`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sparpart`
--
ALTER TABLE `s_group_sparpart`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_sparpart_bill`
--
ALTER TABLE `s_group_sparpart_bill`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `s_group_sparpart_bill_pro`
--
ALTER TABLE `s_group_sparpart_bill_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_group_technician`
--
ALTER TABLE `s_group_technician`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_type`
--
ALTER TABLE `s_group_type`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_typeproduct`
--
ALTER TABLE `s_group_typeproduct`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_id` (`group_id`);

--
-- Indexes for table `s_group_typeproduct_bill`
--
ALTER TABLE `s_group_typeproduct_bill`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `s_group_typeproduct_bill_pro`
--
ALTER TABLE `s_group_typeproduct_bill_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_lang`
--
ALTER TABLE `s_lang`
  ADD PRIMARY KEY (`lang_id`);

--
-- Indexes for table `s_memo`
--
ALTER TABLE `s_memo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mo_id` (`mo_id`);

--
-- Indexes for table `s_module`
--
ALTER TABLE `s_module`
  ADD PRIMARY KEY (`module_id`);

--
-- Indexes for table `s_province`
--
ALTER TABLE `s_province`
  ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `s_quotation`
--
ALTER TABLE `s_quotation`
  ADD PRIMARY KEY (`qu_id`),
  ADD UNIQUE KEY `fs_id` (`fs_id`);

--
-- Indexes for table `s_quotation2`
--
ALTER TABLE `s_quotation2`
  ADD PRIMARY KEY (`qu_id`),
  ADD UNIQUE KEY `fs_id` (`fs_id`);

--
-- Indexes for table `s_quotation3`
--
ALTER TABLE `s_quotation3`
  ADD PRIMARY KEY (`qu_id`);

--
-- Indexes for table `s_quotation4`
--
ALTER TABLE `s_quotation4`
  ADD PRIMARY KEY (`qu_id`);

--
-- Indexes for table `s_quotation_jobcard`
--
ALTER TABLE `s_quotation_jobcard`
  ADD PRIMARY KEY (`qc_id`);

--
-- Indexes for table `s_service_cost`
--
ALTER TABLE `s_service_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_service_report`
--
ALTER TABLE `s_service_report`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report2`
--
ALTER TABLE `s_service_report2`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report2sub`
--
ALTER TABLE `s_service_report2sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report3`
--
ALTER TABLE `s_service_report3`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report3sub`
--
ALTER TABLE `s_service_report3sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report4`
--
ALTER TABLE `s_service_report4`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report4sub`
--
ALTER TABLE `s_service_report4sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_service_report5`
--
ALTER TABLE `s_service_report5`
  ADD PRIMARY KEY (`sr_id`);

--
-- Indexes for table `s_service_report5sub`
--
ALTER TABLE `s_service_report5sub`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `s_signature`
--
ALTER TABLE `s_signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_user`
--
ALTER TABLE `s_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `s_user_group`
--
ALTER TABLE `s_user_group`
  ADD PRIMARY KEY (`user_group_id`);

--
-- Indexes for table `s_user_p`
--
ALTER TABLE `s_user_p`
  ADD PRIMARY KEY (`user_p_id`);

--
-- Indexes for table `tb_menu_cate`
--
ALTER TABLE `tb_menu_cate`
  ADD PRIMARY KEY (`menucate_id`);

--
-- Indexes for table `tb_menu_submenu`
--
ALTER TABLE `tb_menu_submenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_schedule`
--
ALTER TABLE `service_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_approve`
--
ALTER TABLE `s_approve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_backup_database`
--
ALTER TABLE `s_backup_database`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_contract`
--
ALTER TABLE `s_contract`
  MODIFY `ct_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_contract2`
--
ALTER TABLE `s_contract2`
  MODIFY `ct_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_contract3`
--
ALTER TABLE `s_contract3`
  MODIFY `ct_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_document`
--
ALTER TABLE `s_document`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_first_order`
--
ALTER TABLE `s_first_order`
  MODIFY `fo_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group`
--
ALTER TABLE `s_group`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_approve`
--
ALTER TABLE `s_group_approve`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_contract`
--
ALTER TABLE `s_group_contract`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_custommer`
--
ALTER TABLE `s_group_custommer`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_fix`
--
ALTER TABLE `s_group_fix`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_pod`
--
ALTER TABLE `s_group_pod`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_product`
--
ALTER TABLE `s_group_product`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sale`
--
ALTER TABLE `s_group_sale`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_service`
--
ALTER TABLE `s_group_service`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sn`
--
ALTER TABLE `s_group_sn`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart`
--
ALTER TABLE `s_group_sparpart`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart_bill`
--
ALTER TABLE `s_group_sparpart_bill`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_sparpart_bill_pro`
--
ALTER TABLE `s_group_sparpart_bill_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_technician`
--
ALTER TABLE `s_group_technician`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_type`
--
ALTER TABLE `s_group_type`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_typeproduct`
--
ALTER TABLE `s_group_typeproduct`
  MODIFY `group_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_typeproduct_bill`
--
ALTER TABLE `s_group_typeproduct_bill`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_group_typeproduct_bill_pro`
--
ALTER TABLE `s_group_typeproduct_bill_pro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_lang`
--
ALTER TABLE `s_lang`
  MODIFY `lang_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_memo`
--
ALTER TABLE `s_memo`
  MODIFY `id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_module`
--
ALTER TABLE `s_module`
  MODIFY `module_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_province`
--
ALTER TABLE `s_province`
  MODIFY `province_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_quotation`
--
ALTER TABLE `s_quotation`
  MODIFY `qu_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_quotation2`
--
ALTER TABLE `s_quotation2`
  MODIFY `qu_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_quotation3`
--
ALTER TABLE `s_quotation3`
  MODIFY `qu_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_quotation4`
--
ALTER TABLE `s_quotation4`
  MODIFY `qu_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_quotation_jobcard`
--
ALTER TABLE `s_quotation_jobcard`
  MODIFY `qc_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_cost`
--
ALTER TABLE `s_service_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report`
--
ALTER TABLE `s_service_report`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report2`
--
ALTER TABLE `s_service_report2`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report2sub`
--
ALTER TABLE `s_service_report2sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report3`
--
ALTER TABLE `s_service_report3`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report3sub`
--
ALTER TABLE `s_service_report3sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report4`
--
ALTER TABLE `s_service_report4`
  MODIFY `sr_id` int(14) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report4sub`
--
ALTER TABLE `s_service_report4sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_service_report5sub`
--
ALTER TABLE `s_service_report5sub`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_signature`
--
ALTER TABLE `s_signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user`
--
ALTER TABLE `s_user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user_group`
--
ALTER TABLE `s_user_group`
  MODIFY `user_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `s_user_p`
--
ALTER TABLE `s_user_p`
  MODIFY `user_p_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_menu_cate`
--
ALTER TABLE `tb_menu_cate`
  MODIFY `menucate_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_menu_submenu`
--
ALTER TABLE `tb_menu_submenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
