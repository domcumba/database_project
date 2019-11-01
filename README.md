# DATABASE Management Class
## Project
### DM

To get the login system to work, I think you can copy and paste this into phpmyadmin to create the table for it. I'll also include a screenshot of it. The attribute names in the code I uploaded will only work with the specific attribute names in the table I was testing with if you want to try it out.

CREATE TABLE users (
  user_ID int(11) PRIMARY KEY NOT NULL,
  username varchar(50) NOT NULL,
  user_email varchar(50) NOT NULL,
  user_password varchar(50) NOT NULL
);
