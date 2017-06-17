<?php
/* 
 * define.php
 * @time 2017/06/17
 * @author meng.xu 
 *  */

/* ----- define constant ----- */
define("__UPLOAD__", "uploads");
define("__UPLOAD_PATH__", ROOT_PATH."public".DS.__UPLOAD__.DS."index");



/* ----- define table ----- */
/*    
 * nbateam table
 */
define("DB_NBATEAM_TAB", "nbateam");
define("DB_NBATEAM_ID", "Id");
define("DB_NBATEAM_NAME", "Name");
define("DB_NBATEAM_LOGO", "Logo");
define("DB_NBATEAM_WIN", "Win");
define("DB_NBATEAM_LOSE", "Lose");
define("DB_NBATEAM_RANK", "Rank");
define("DB_NBATEAM_ALLIANCE", "Alliance");
define("DB_NBATEAM_PLAYOFFS", "Playoffs");
define("DB_NBATEAM_PARTITION", "Partition");

/*    
 * news table
 */
define("DB_NEWS_TAB", "news");
define("DB_NEWS_ID", "id");
define("DB_NEWS_TITLE", "title");
define("DB_NEWS_CONTENT", "content");