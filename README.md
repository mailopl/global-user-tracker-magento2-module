# magento2 cookie-less user tracking
This magento2 module allows you to perform cookie-less user tracking based on fingerprinted global user id.

Initial version supports products tracking per user, meaning you have a possibility to preview every last 10 viewed products of your not-logged in users.

### How does it work?
On product page there’s an ajax request in the background that sends your rather unique fingerprint to this modules endpoint and saves it into `global_user_statistics` table.

### Admin section
Find “Global User tracker” on the left hand menu.

### How is fingerprint calculated?
Based on user agent, window width, height, sessionStorage, localStorage, plugins, timezone..

But be aware - that’s not the best possible version of the fingerprinting method, so feel free to change it depending on your needs.

### Database notes
Table `global_user_statistics` is created 
```
+------------------------------+------------------+------+-----+---------+----------------+
| Field                        | Type             | Null | Key | Default | Extra          |
+------------------------------+------------------+------+-----+---------+----------------+
| ‌id                           | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| guid                         | int(10) unsigned | NO   |     | NULL    |                |
| productId                    | int(11)          | YES  | MUL | NULL    |                |
| createdAt                    | datetime         | YES  |     | NULL    |                |
+------------------------------+------------------+------+-----+---------+----------------+
```