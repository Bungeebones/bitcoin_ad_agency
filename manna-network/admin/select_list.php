SELECT * FROM `cat_paginator`; /* 
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `total_subs` int(11) NOT NULL,
  `tot_pages` int(3) DEFAULT NULL,
  `cat_name_trims` text CHARACTER SET latin1,
  PRIMARY KEY;`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1633 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `cat_region_bridge`; /*
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(12) NOT NULL,
  `link_id` int(12) NOT NULL,
  `region_id` int(12) NOT NULL,
  PRIMARY KEY;`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `categories`; /*
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `parent` int(21) DEFAULT '1',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `is_paginated` int(4) NOT NULL,
  `BB_User_ID` smallint(8) DEFAULT NULL,
  `is_niche` tinyint(1) DEFAULT NULL,
  `price` tinyint(3) NOT NULL DEFAULT '0',
  `price_date` int(11) DEFAULT NULL,
  `population` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pop_cont` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pop_country` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pop_state` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pop_city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `click_tally` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY;`id`),
  KEY `id`; `id`),
  KEY `id_2`; `id`)
) ENGINE=MyISAM AUTO_INCREMENT=10035 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `categories_regional2`; /*
  `id` int(21) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `parent` int(21) DEFAULT '1',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  UNIQUE KEY `lft_rgt`; `lft`,`rgt`),
  KEY `parent`; `parent`),
  KEY `lft`; `lft`),
  KEY `rgt`; `rgt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `links`; /*
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `BB_user_ID` int(8) DEFAULT NULL,
  `category` varchar(21) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `temp` int(1) NOT NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `approved` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT 'false',
  `non_detectable` int(1) NOT NULL DEFAULT '0',
  `is_a_modified` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` int(20) NOT NULL DEFAULT '0',
  `nofollow` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'on',
  UNIQUE KEY `id_2`; `id`),
  KEY `id`; `id`),
  KEY `id_3`; `id`),
  KEY `category`; `category`)
) ENGINE=InnoDB AUTO_INCREMENT=8088 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `local_info`; /*
  `id` int(21) NOT NULL,
  `BB_user_ID` int(8) DEFAULT NULL,
  `category` varchar(21) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `temp` int(1) NOT NULL DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `approved` varchar(25) CHARACTER SET utf8 NOT NULL DEFAULT 'false',
  `send_API_type` varchar(4) CHARACTER SET utf8 NOT NULL,
  `non_detectable` int(1) NOT NULL DEFAULT '0',
  `is_a_modified` tinyint(1) NOT NULL DEFAULT '0',
  `street` varchar(66) CHARACTER SET utf8 DEFAULT NULL,
  `zip` varchar(66) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(66) CHARACTER SET utf8 DEFAULT NULL,
  `freebie` tinyint(1) DEFAULT NULL,
  `start_date` int(20) NOT NULL DEFAULT '0',
  `price_slot_amnt` decimal(16,8) NOT NULL DEFAULT '0.00000000',
  `ps_seniority_date` int(10) NOT NULL DEFAULT '0',
  `nofollow` varchar(10) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `peer_rating`; /*
  `id` int(21) NOT NULL,
  `BB_user_ID` int(8) DEFAULT NULL,
  `peer_rating` int(11) DEFAULT '0',
  `peer_vote_count` int(11) NOT NULL DEFAULT '0',
  `public_rating` int(11) DEFAULT '0',
  `public_vote_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `plus2_city`; /*
  `city_id` int(4) NOT NULL AUTO_INCREMENT,
  `state_id` int(3) NOT NULL DEFAULT '0',
  `city` char(35) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY;`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `plus2_country`; /*
  `country_code` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `country` varchar(20) CHARACTER SET latin1 NOT NULL,
  UNIQUE KEY `country_code`; `country_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `plus2_state`; /*
  `state_id` int(3) NOT NULL AUTO_INCREMENT,
  `state` char(20) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `country_code` char(3) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY;`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `price_slot_gen`; /*
  `id` int(6) NOT NULL,
  `cat_id` int(6) DEFAULT '0',
  `cat_name` varchar(50) DEFAULT NULL,
  `base_price` decimal(16,8) NOT NULL,
  `Google_price` decimal(16,8) DEFAULT NULL,
  `adj_factor` decimal(16,8) NOT NULL,
  `query_multiplier` decimal(16,8) NOT NULL,
  `query_30_day_tot` int(6) NOT NULL DEFAULT '0',
  `t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

SELECT * FROM `price_slots_subscripts`; /*
  `id` int(6) NOT NULL,
  `user_id` int(8) NOT NULL DEFAULT '0',
  `link_id` int(8) NOT NULL,
  `wdgts_lnk_num` int(6) NOT NULL DEFAULT '0',
  `wdgts_ID` int(10) NOT NULL,
  `price_slot_amnt` decimal(35,29) NOT NULL DEFAULT '0.00000000000000000000000000000',
  `subscribe` varchar(5) DEFAULT NULL,
  `coin_type` varchar(8) NOT NULL,
  `cat_id` int(5) NOT NULL DEFAULT '0',
  `t_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `start_date` varchar(19) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

SELECT * FROM `regional_sign_ups`; /*
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `continent` int(6) NOT NULL DEFAULT '0',
  `country` int(6) NOT NULL DEFAULT '0',
  `state` int(6) NOT NULL DEFAULT '0',
  `district1` int(6) NOT NULL DEFAULT '0',
  `city` int(6) NOT NULL DEFAULT '0',
  `district2` int(6) NOT NULL DEFAULT '0',
  `street` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `link_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(10) NOT NULL,
  PRIMARY KEY;`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4555 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `rt_categories`; /*
  `id` int(10) NOT NULL,
  `name` varchar(55) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` int(10) NOT NULL,
  `lft` int(10) NOT NULL,
  `rgt` int(10) NOT NULL,
  PRIMARY KEY;`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/

SELECT * FROM `widgets`; /*
  `id` int(21) NOT NULL AUTO_INCREMENT,
  `link_id` int(6) NOT NULL DEFAULT '0',
  `parent` int(10) DEFAULT '0',
  `lft` int(10) NOT NULL DEFAULT '0',
  `rgt` int(10) NOT NULL DEFAULT '0',
  `time_period` tinyint(1) NOT NULL DEFAULT '8',
  `version` varchar(50) CHARACTER SET utf8 NOT NULL,
  `start_clone_date` int(10) DEFAULT NULL,
  `end_clone_date` varchar(30) CHARACTER SET utf8 NOT NULL,
  `display_freebies` varchar(16) CHARACTER SET utf8 DEFAULT NULL,
  `click_tally` int(10) DEFAULT NULL,
  PRIMARY KEY;`id`),
  KEY `parent`; `parent`)
) ENGINE=InnoDB AUTO_INCREMENT=1774 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_*/
