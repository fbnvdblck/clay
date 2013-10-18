Clay
====

**Lightweight PHP5 Framework** to develop *small* and *simple* **Web applications**.

**Clay** contains:
* a router with URL Rewriting, parameters (based on regex) included
* a MVC architecture
* the database API PDO with several configurations availables
* configurations files (database, url alias, ...) in YAML language
* a template system call **Twig** provided by Sensio Labs
* a mailer feature
* a logger feature with debug

**How to install** 

1. Extract Clay on your Web server
2. Create at the root the folder 'logs' and 'cache' with good permissions (chmod 777)
3. If you want use your own classes, create the folder 'model' in src/
4. Your web application must be available only on folder web/
