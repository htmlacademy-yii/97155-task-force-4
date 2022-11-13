CREATE
DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE
taskforce;

CREATE TABLE city
(
  id   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(128)   NOT NULL,
  lat  DECIMAL(11, 8) NOT NULL,
  lng  DECIMAL(11, 8) NOT NULL
);

CREATE TABLE user
(
  id                INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name              VARCHAR(128) NOT NULL,
  role              TINYINT      NOT NULL,
  email             VARCHAR(50)  NOT NULL UNIQUE,
  password          VARCHAR(64)  NOT NULL,
  city_id           INT UNSIGNED NOT NULL,
  birthdate         DATE NULL,
  bio               TEXT NULL,
  avatar            VARCHAR(300) NULL,
  phone             VARCHAR(12) NULL,
  telegram          VARCHAR(50) NULL,
  rating            DECIMAL(2, 1)         DEFAULT 0,
  failed_task_count INT UNSIGNED DEFAULT 0,
  show_bio          TINYINT      NOT NULL DEFAULT 1,
  created_at        DATETIME     NOT NULL DEFAULT NOW(),
  updated_at        DATETIME NULL,
  FOREIGN KEY (city_id) REFERENCES city (id)
);

CREATE TABLE category
(
  id    INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name  VARCHAR(50) NOT NULL,
  alias VARCHAR(50) NOT NULL
);

CREATE TABLE category_user
(
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id     INT UNSIGNED NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  FOREIGN KEY (user_id) REFERENCES user (id),
  FOREIGN KEY (category_id) REFERENCES category (id)
);

CREATE TABLE task
(
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(128) NOT NULL,
  description TEXT         NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  city_id     INT UNSIGNED NOT NULL,
  address     VARCHAR(300) NULL,
  budget      INT UNSIGNED NULL,
  deadline    DATETIME     NOT NULL,
  customer_id INT UNSIGNED NOT NULL,
  executor_id INT UNSIGNED NULL,
  status      TINYINT UNSIGNED NOT NULL DEFAULT 1,
  created_at  DATETIME     NOT NULL DEFAULT NOW(),
  updated_at  DATETIME NULL,
  FOREIGN KEY (city_id) REFERENCES city (id),
  FOREIGN KEY (category_id) REFERENCES category (id),
  FOREIGN KEY (customer_id) REFERENCES user (id),
  FOREIGN KEY (executor_id) REFERENCES user (id)
);

CREATE TABLE response
(
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id    INT UNSIGNED NOT NULL,
  task_id    INT UNSIGNED NOT NULL,
  comment    TEXT NULL,
  budget     INT UNSIGNED NOT NULL,
  refused    TINYINT  NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT NOW(),
  updated_at DATETIME NULL,
  FOREIGN KEY (user_id) REFERENCES user (id),
  FOREIGN KEY (task_id) REFERENCES task (id)
);

CREATE TABLE review
(
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id    INT UNSIGNED NOT NULL,
  task_id    INT UNSIGNED NOT NULL,
  comment    TEXT NULL,
  rating     TINYINT  NOT NULL,
  created_at DATETIME NOT NULL DEFAULT NOW(),
  FOREIGN KEY (user_id) REFERENCES user (id),
  FOREIGN KEY (task_id) REFERENCES task (id)
);

CREATE TABLE file
(
  id      INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  task_id INT UNSIGNED NOT NULL,
  path    VARCHAR(300) NOT NULL,
  FOREIGN KEY (task_id) REFERENCES task (id)
);

