# Create

Create an application on the server.

### HTTP Request:
```
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications
```

## Custom Application

### Parameter:

| Parameter              | Required | Type      | Description                                                                                   |
|:----------------------- |:--------- |:--------- |:---------------------------------------------------------------------------------------------- |
| name                   | Yes       | String    | The name of the application.                                                                  |
| method                 | Yes       | String    | The method used, which should be `custom`.                                                    |
| framework              | Yes       | String    | The framework used, which should be `custom`.                                                 |
| temp_domain            | Yes       | Boolean   | Set to `true` if you want to use a ServerAvatar domain.                                       |
| temp_sub_domain_name   | No        | String    | Required if temp_domain is true. Specifies the temporary subdomain name.                      |
| hostname               | No        | String    | Required if temp_domain is false. Specifies the hostname for the application.                 |
| systemUser             | Yes       | String    | Indicates the type of system user: `new` to create a new system user, or `existing` to use an existing one. |
| systemUserId           | No        | Numeric   | Required if systemUser is `existing`. Specifies the ID of the existing system user.              |
| systemUserInfo[username] | No      | String    | Required if systemUser is `new`. Specifies the username for the new system user.                |
| systemUserInfo[password] | No      | String    | Required if systemUser is `new`. Specifies the password for the new system user.                |
| php_version            | Yes       | Numeric   | Specifies the PHP version for the application. Must be one of `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2`, `8.3` or `8.4`. |
| webroot                | No        | String    | Specifies the webroot path if a custom webroot is needed.                                      |
| www                    | Yes       | Boolean   | Set to `true` if you want to add the `www` domain to your application.                        |

### cRUL Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "custom",
    "framework": "custom",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "php_version": "8.2",
    "webroot": "",
    "www": false,
  }'
```

## WordPress Application

### Parameter:

| **Parameter**                   | **Required** | **Type**      | **Description**                                                                                           |
|---------------------------------|--------------|---------------|-----------------------------------------------------------------------------------------------------------|
| name                        | Yes          | String        | The name of the WordPress application.                                                                    |
| method                      | Yes          | String        | The method of installation. Must be `one_click`.                                                          |
| framework                   | Yes          | String        | The framework for the application. Must be `wordpress`.                                                   |
| temp_domain                 | Yes          | Boolean       | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain.     |
| temp_sub_domain_name        | No           | String        | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                    | No           | String        | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser                  | Yes          | String        | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId                | No           | Numeric       | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]    | No           | String        | Required if `systemUser` is `new`. The username for the new system user.                                 |
| systemUserInfo[password]    | No           | String        | Required if `systemUser` is `new`. The password for the new system user.                                 |
| webroot                     | No           | String        | The webroot path for the application. Specify if a custom webroot is needed.                              |
| timezone                    | No           | String        | The timezone for the WordPress site. You can get a list of timezones from the [API](#timezone).           |
| site_language               | No           | String        | The language for the WordPress site. You can get available languages from the [API](#wordpress-languages). |
| www                         | Yes          | Boolean       | Set to `true` if you want to add the `www` prefix to your domain.                                         |
| email                       | No           | String        | The email address for the WordPress site. Must be a valid email if provided.                             |
| title                       | Yes          | String        | The title of your WordPress application.                                                                  |
| username                    | Yes          | String        | The admin username for your WordPress application.                                                        |
| password                    | Yes          | String        | The admin password for your WordPress application.                                                        |
| install_litespeed_cache_plugin | Yes        | Boolean       | Set to `true` if you want to install the LiteSpeed Cache Plugin. This is required when the web server is OpenLiteSpeed. |
| database_server             | No           | Numeric       | The ID of the remote database server to use.                                                               |
| database_name               | Yes          | Alpha-Numeric | The name of the database to be used for the WordPress application.                                        |
| php_version                 | Yes          | Numeric       | The PHP version to be used. Choose from `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2`, `8.3` or `8.4`.              |
| db_prefix                   | No           | String        | The prefix for database tables. Should contain only letters, numbers and underscores, with the last character being an underscore. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "wordpress",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "php_version": "8.2",
    "webroot": "",
    "timezone": "Asia/Kolkata",
    "site_language": "Afrikaans",
    "www": false,
    "email": "admin@mysite.com",
    "title":"wordpressapp",
    "username":"username",
    "password":"username@123",
    "install_litespeed_cache_plugin":false,
    "database_name":"wordpress",
    "db_prefix":"wp_"
  }'
```

# Wordpress Languages

Retrieve the languages available in the WordPress application.

### HTTP Request:

```js
GET https://api.serveravatar.com/wp/languages
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/wp/languages" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Languages

- __200__ (Ok)

``` json
{
    "languages": [
        {
        "language": "af",
        "english_name": "Afrikaans",
        "native_name": "Afrikaans"
        },
        {
        "language": "am",
        "english_name": "Amharic",
        "native_name": "አማርኛ"
        },
        ...
    ]
}
```

# Timezone

Retrieve the timezone.

### HTTP Request:

```js
GET https://api.serveravatar.com/timezone
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/timezone" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' 
```

### Response:

#### Timezone

- __200__ (Ok)

``` json
{
    "Pacific/Midway": "(UTC-11:00) Pacific/Midway",
    "Pacific/Niue": "(UTC-11:00) Pacific/Niue",
    "Pacific/Pago_Pago": "(UTC-11:00) Pacific/Pago_Pago",
    "Pacific/Honolulu": "(UTC-10:00) Pacific/Honolulu",
    "Pacific/Rarotonga": "(UTC-10:00) Pacific/Rarotonga",
    "Pacific/Tahiti": "(UTC-10:00) Pacific/Tahiti",
    "Pacific/Marquesas": "(UTC-09:30) Pacific/Marquesas",
    ...
}
```

## Mautic Application

### Parameter:

| **Parameter**          | **Required** | **Type**      | **Description**                                                                                           |
|------------------------|--------------|---------------|-----------------------------------------------------------------------------------------------------------|
| name               | Yes          | String        | The name of the Mautic application.                                                                      |
| method             | Yes          | String        | Method of installation. Must be `one_click`.                                                             |
| framework          | Yes          | String        | Framework for the application. Must be `mautic`.                                                         |
| temp_domain        | Yes          | Boolean       | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain.     |
| temp_sub_domain_name | No         | String        | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname           | No           | String        | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser         | Yes          | String        | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId       | No           | Numeric       | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username] | No       | String        | Required if `systemUser` is `new`. The username for the new system user.                                 |
| systemUserInfo[password] | No       | String        | Required if `systemUser` is `new`. The password for the new system user.                                 |
| webroot            | No           | String        | The webroot path for the application. Specify if a custom webroot is needed.                              |
| www                | Yes          | Boolean       | Set to `true` if you want to add the `www` prefix to your domain.                                         |
| firstname          | Yes          | String        | The first name for the Mautic site user.                                                                  |
| lastname           | Yes          | String        | The last name for the Mautic site user.                                                                   |
| email              | No           | String        | The email address for the Mautic site. Must be a valid email if provided.                                |
| title              | Yes          | String        | The title of your Mautic site.                                                                          |
| username           | Yes          | String        | The admin username for your Mautic site.                                                                  |
| password           | Yes          | String        | The admin password for your Mautic site.                                                                  |
| mailer_name        | Yes          | String        | The mailer name for email configuration.                                                                  |
| mailer_email       | No           | String        | The mailer email for email configuration.                                                                  |
| mailer_host        | Yes          | String        | The mailer host for email configuration.                                                                  |
| mailer_port        | Yes          | Numeric       | The mailer port for email configuration.                                                                  |
| mailer_username    | Yes          | String        | The mailer username for email configuration.                                                              |
| mailer_password    | Yes          | String        | The mailer password for email configuration.                                                              |
| database_server    | No           | Numeric       | The ID of the remote database server to use.                                                               |
| database_name      | Yes          | Alpha-Numeric | The name of the database to be used for the Mautic application.                                            |
| php_version        | Yes          | String        | The PHP version to be used. Choose from `7.4` or `8.0`.                                                   |


### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "mautic",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "webroot": "",
    "www": false,
    "firstname":"firstname",
    "lastname":"lastname",
    "email": "admin@mysite.com",
    "title":"mauticapp",
    "username":"username",
    "password":"username@123",
    "mailer_name":"test",
    "mailer_host":"test",
    "mailer_port":25,
    "mailer_username":"test",
    "mailer_password":"test@123",
    "php_version":"7.4",
    "database_name":"mauticapp"
  }'
```

## Moodle Application

### Parameter:

| **Parameter**           | **Required** | **Type**      | **Description**                                                                                           |
|-------------------------|--------------|---------------|-----------------------------------------------------------------------------------------------------------|
| name                | Yes          | String        | The name of the Moodle application.                                                                      |
| method              | Yes          | String        | Method of installation. Must be `one_click`.                                                             |
| framework           | Yes          | String        | Framework for the application. Must be `moodle`.                                                         |
| temp_domain         | Yes          | Boolean       | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain.     |
| temp_sub_domain_name | No         | String        | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname            | No           | String        | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser          | Yes          | String        | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId        | No           | Numeric       | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username] | No       | String        | Required if `systemUser` is `new`. The username for the new system user.                                 |
| systemUserInfo[password] | No       | String        | Required if `systemUser` is `new`. The password for the new system user.                                 |
| webroot             | No           | String        | The webroot path for the application. Specify if a custom webroot is needed.                              |
| www                 | Yes          | Boolean       | Set to `true` if you want to add the `www` prefix to your domain.                                         |
| fullname            | Yes          | String        | The full name of your Moodle site.                                                                        |
| shortname           | Yes          | String        | The short name of your Moodle site.                                                                       |
| email               | No           | String        | The email address for the Moodle site. Must be a valid email if provided.                                |
| summary             | Yes          | String        | A summary or description of your Moodle site.                                                             |
| username            | Yes          | String        | The admin username for your Moodle site.                                                                  |
| password            | Yes          | String        | The admin password for your Moodle site.                                                                  |
| support_email       | No           | String        | The support email address for the Moodle site.                                                            |
| database_server     | No           | Numeric       | The ID of the remote database server to use.                                                               |
| database_name       | Yes          | Alpha-Numeric | The name of the database to be used for the Moodle application.                                            |
| php_version         | Yes          | String        | The PHP version to be used. Choose from `8.0`, `8.1`, `8.2`, or `8.3`.                                   |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "moodle",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "webroot": "",
    "www": false,
    "fullname": "fullname",
    "shortname": "shortname",
    "summary": "moodleapp",
    "username": "username",
    "password": "username@123",
    "php_version": "8.0",
    "database_name": "moodleapp"
  }'
```

## Joomla Application

### Parameter:

| Parameter               | Required | Type      | Description                                                                                           |
|-------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                    | Yes      | String    | The name of the Joomla application.                                                                  |
| method                  | Yes      | String    | Method of installation. Must be `one_click`.                                                         |
| framework               | Yes      | String    | Framework for the application. Must be `joomla`.                                                     |
| temp_domain             | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name    | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser              | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId            | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]| No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]| No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| webroot                 | No       | String    | The webroot path for the application. Specify if a custom webroot is needed.                          |
| www                     | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| php_version             | Yes      | String    | The PHP version to be used. Choose from `7.4`, `8.0`, `8.1`, `8.2`, or `8.3`.                      |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "joomla",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "webroot": "",
    "www": false,
    "php_version":"7.4"
  }'
```

## Prestashop Application

### Parameter:

| Parameter               | Required | Type      | Description                                                                                           |
|-------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                    | Yes      | String    | The name of the PrestaShop application.                                                               |
| method                  | Yes      | String    | Method of installation. Must be `one_click`.                                                         |
| framework               | Yes      | String    | Framework for the application. Must be `prestashop`.                                                  |
| temp_domain             | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name    | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser              | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId            | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]| No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]| No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| webroot                 | No       | String    | The webroot path for the application. Specify if a custom webroot is needed.                          |
| www                     | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| firstname               | Yes      | String    | The first name for your PrestaShop site.                                                              |
| lastname                | Yes      | String    | The last name for your PrestaShop site.                                                               |
| email                   | No       | String    | The email address for your PrestaShop site. Must be a valid email if provided.                       |
| password                | Yes      | String    | The password for your PrestaShop site.                                                                |
| database_server         | No       | Numeric   | The ID of the remote database server to use.                                                           |
| database_name           | Yes      | Alpha-Numeric | The name of the database to be used for the PrestaShop application.                                    |
| php_version             | Yes      | String    | The PHP version to be used. Choose from `8.1`, `8.2`, or `8.3`.                                      |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "prestashop",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "webroot": "",
    "www": false,
    "firstname": "firstname",
    "lastname": "lastname",
    "password": "username@123",
    "php_version": "8.1",
    "database_name": "prestashop"
  }'
```

## Akaunting Application

### Parameter:

| Parameter                 | Required | Type      | Description                                                                                           |
|---------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                      | Yes      | String    | The name of the Akaunting application.                                                                |
| method                    | Yes      | String    | Method of installation. Must be `one_click`.                                                          |
| framework                 | Yes      | String    | Framework for the application. Must be `akaunting`.                                                   |
| temp_domain               | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name      | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                  | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser                | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId              | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]  | No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]  | No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| www                       | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| email                     | No       | String    | The email address for your Akaunting site. Must be a valid email if provided.                       |
| password                  | Yes      | String    | The admin password for your Akaunting application.                                                    |
| php_version               | Yes      | Numeric   | The PHP version to be used. Choose from `8.1`, `8.2`, `8.3` or `8.4`.                                      |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "akaunting",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "www": false,
    "email": "admin@mysite.com",
    "password":"username@123",
    "php_version": "8.2",
  }'
```

## Statamic Application

### Parameter:

| Parameter                 | Required | Type      | Description                                                                                           |
|---------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                      | Yes      | String    | The name of the Statamic application.                                                                |
| method                    | Yes      | String    | Method of installation. Must be `one_click`.                                                          |
| framework                 | Yes      | String    | Framework for the application. Must be `statamic`.                                                   |
| temp_domain               | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name      | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                  | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser                | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId              | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]  | No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]  | No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| www                       | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| email                     | Yes      | String   | The email address for your Statamic site. Must be a valid email if provided.                       |
| password                  | Yes      | String    | The password for your Statamic application.                                                    |
| php_version               | Yes      | Numeric   | The PHP version to be used. Choose from `8.2`, `8.3` or `8.4`.                                      |
| webroot                   | Yes      | String    | The webroot path for the application. Specify `public` webroot.                          |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "statamic",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "www": false,
    "email": "admin@mysite.com",
    "password":"username@123",
    "php_version": "8.2",
    "webroot": "public"
  }'
```

## Nextcloud Application

### Parameter:

| Parameter                 | Required | Type      | Description                                                                                           |
|---------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                      | Yes      | String    | The name of the Nextcloud application.                                                                |
| method                    | Yes      | String    | Method of installation. Must be `one_click`.                                                          |
| framework                 | Yes      | String    | Framework for the application. Must be `nextcloud`.                                                   |
| temp_domain               | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name      | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                  | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser                | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId              | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]  | No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]  | No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| www                       | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| email                     | No       | String    | The email address for your Nextcloud site. Must be a valid email if provided.                       |
| username                  | Yes      | String    | The admin username for your Nextcloud application.                                                    |
| password                  | Yes      | String    | The admin password for your Nextcloud application.                                                    |
| database_server           | No       | Numeric   | The ID of the remote database server to use.                                                           |
| database_name             | Yes      | Alpha-Numeric | The name of the database to be used for the Nextcloud application.                                      |
| php_version               | Yes      | Numeric   | The PHP version to be used. Choose from `8.2` or `8.3`.                                                |


### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "nextcloud",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "php_version": "8.2",
    "www": false,
    "email": "admin@mysite.com",
    "username":"username",
    "password":"username@123",
    "database_name":"nextcloud"
  }'
```

## PhpMyAdmin Application

### Parameter:

| Parameter                 | Required | Type      | Description                                                                                           |
|---------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                      | Yes      | String    | The name of the PhpMyAdmin application.                                                                |
| method                    | Yes      | String    | Method of installation. Must be `one_click`.                                                          |
| framework                 | Yes      | String    | Framework for the application. Must be `phpmyadmin`.                                                   |
| temp_domain               | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name      | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname                  | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser                | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId              | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username]  | No       | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password]  | No       | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| www                       | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| php_version               | Yes      | String    | The PHP version to be used. Choose from `7.4`, `8.0`, `8.1`, `8.2`, `8.3` or `8.4`.                       |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "one_click",
    "framework": "phpmyadmin",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "www": false,
    "php_version":"7.4"
  }'
```

## Git Application

### Parameter:

| Parameter              | Required | Type      | Description                                                                                           |
|------------------------|----------|-----------|-------------------------------------------------------------------------------------------------------|
| name                   | Yes      | String    | The name of the Git application.                                                                      |
| method                 | Yes      | String    | Method of installation. Must be `git`.                                                                |
| framework              | Yes      | String    | Select one framework: `bitbucket`, `github`, or `gitlab`.                                             |
| temp_domain            | Yes      | Boolean   | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain. |
| temp_sub_domain_name   | No       | String    | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain. |
| hostname               | No       | String    | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain. |
| systemUser             | Yes      | String    | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one. |
| systemUserId           | No       | Numeric   | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created. |
| systemUserInfo[username] | No     | String    | Required if `systemUser` is `new`. The username for the new system user.                             |
| systemUserInfo[password] | No     | String    | Required if `systemUser` is `new`. The password for the new system user.                             |
| webroot                | No       | String    | The webroot path for the application. Specify if a custom webroot is needed.                          |
| www                    | Yes      | Boolean   | Set to `true` if you want to add the `www` prefix to your domain.                                     |
| type                   | Yes      | String    | Select one: `private` or `public`.                                                                     |
| file_name              | No       | String    | Required if `type` is `private`. Use file_name value from generate ssh-key API response.                |
| git_provider_id        | No       | Numeric   | Required if `type` is `private`. The selected provider's account ID.                                  |
| workspace_slug         | No       | String    | Required if `type` is `private` and provider is `bitbucket`.                                           |
| repository_slug        | No       | String    | Required if `type` is `private` and provider is `bitbucket`.                                           |
| username               | No       | String    | Required if `type` is `private` and provider is `github`.                                             |
| repository_name        | No       | String    | Required if `type` is `private` and provider is `github`.                                             |
| project_id             | No       | String    | Required if `type` is `private` and provider is `gitlab`.                                             |
| repository             | No       | String    | Required if `type` is `private`. The selected repository.                                              |
| clone_url              | No       | String    | Required if `type` is `public`. The clone URL for the repository.                                     |
| branch                 | Yes      | String    | The branch name to be used.                                                                           |
| php_version            | Yes      | Numeric   | The PHP version to be used. Choose from `7.2`, `7.3`, `7.4`, `8.0`, `8.1`, `8.2`, `8.3` or `8.4`.         |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "git",
    "framework": "github",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "php_version":"7.3",
    "webroot": "",
    "www": false,
    "type": "private",
    "file_name": "oQUmjZjxc51B1Hyzk9xPhyjTOtWcRIXw",
    "git_provider_id": 12,
    "repository": "test/laravel-test",
    "username": "test",
    "repository_name": "laravel-test",
    "branch": "master"
  }'
```

### Response:

#### Application Created:

- __200__ (Ok)

```json
{
  "message": "Git application has been installed successfully!",
  "application": {
    "id": 5,
    "system_user_id": 4,
    "framework": "custom",
    "name": "myapp",
    "primary_domain": "my-app.com",
    "webroot": null,
    "php_version": "8.2",
    "pm_type": "ondemand",
    "pm_max_children": 20,
    "pm_start_servers": 2,
    "pm_min_spare_servers": 1,
    "pm_max_spare_servers": 3,
    "pm_process_idle_timeout": 30,
    "pm_max_requests": 500,
    "pm_max_spawn_rate": 1,
    ....
  }
}
```

## Node Application

### Parameter:

| Parameter               | Required | Type     | Description                                                                                                                                                      |
|-------------------------|----------|----------|------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| name                    | Yes      | String   | The name of the Node application.                                                                                                                               |
| method                  | Yes      | String   | Select one method: `git` or `one_click`.                                                                                                                          |
| framework               | Yes      | String   | If `method` is `git`, select one framework: `bitbucket`, `github`, or `gitlab`. If `method` is `one_click`, select one framework: `uptimekuma`, `nodered`, `n8n`, or `nodebb`. |
| temp_domain             | Yes      | Boolean  | Set to `true` if you want to use a ServerAvatar temporary domain. Set to `false` for a custom domain.                                                            |
| temp_sub_domain_name    | No       | String   | Required if `temp_domain` is `true`. Specifies the temporary subdomain to be used with the ServerAvatar domain.                                                   |
| hostname                | No       | String   | Required if `temp_domain` is `false`. The custom hostname to be used if not using a ServerAvatar domain.                                                         |
| systemUser              | Yes      | String   | Indicates the type of system user. Choose `new` to create a new system user or `existing` to use an existing one.                                                |
| systemUserId            | No       | Numeric  | Required if `systemUser` is `existing`. The ID of the existing system user under which the application will be created.                                           |
| systemUserInfo[username] | No      | String   | Required if `systemUser` is `new`. The username for the new system user.                                                                                        |
| systemUserInfo[password] | No      | String   | Required if `systemUser` is `new`. The password for the new system user.                                                                                        |
| webroot                 | No       | String   | The webroot path for the application. Specify if a custom webroot is needed. Only applicable if the `method` is `git`.                                           |
| www                     | Yes      | Boolean  | Set to `true` if you want to add the `www` prefix to your domain.                                                                                               |
| type                    | Yes      | String   | If `method` is `git`, select either `private` or `public`.                                                                                                       |
| file_name               | No       | String   | Required if the `method` is `git` and the `type` is `private`. Use the `file_name` value from the generate SSH key API response.                                    |
| git_provider_id         | No       | Numeric  | Required if the `method` is `git` and the `type` is `private`. This is the selected framework's account ID.                                                       |
| workspace_slug          | No       | String   | Required if the `method` is `git`, the `type` is `private`, and the `framework` is `bitbucket`.                                                                  |
| repository_slug         | No       | String   | Required if the `method` is `git`, the `type` is `private`, and the `framework` is `bitbucket`.                                                                  |
| username                | No       | String   | Required if the `method` is `git`, the `type` is `private`, and the `framework` is `github`. Also required if the `framework` is `nodebb` or `nodered`.           |
| password                | No       | String   | Required if the `framework` is `nodebb` or `nodered`.                                                                                                           |
| email                   | No       | String   | Required if the `framework` is `nodebb`.                                                                                                                          |
| repository_name         | No       | String   | Required if the `method` is `git`, the `type` is `private`, and the `framework` is `github`.                                                                     |
| project_id              | No       | String   | Required if the `method` is `git`, the `type` is `private`, and the `framework` is `gitlab`.                                                                     |
| repository              | No       | String   | Required if the `method` is `git` and the `type` is `private`. The selected repository.                                                                          |
| clone_url               | No       | String   | Required if the `method` is `git` and the `type` is `public`. The clone URL for the repository.                                                                 |
| branch                  | No       | String   | Required if the `method` is `git`. The branch name to be used.                                                                                                  |
| rendering               | No       | String   | Required if the `method` is `git`. Must be one of: `static`, `ssr`, or `csr`.                                                                                  |
| package_manager         | Yes      | String   | Select any one : `npm` or `yarn`                                                                                  |
| process_mode            | Yes      | String   | Select any one : `fork` or `cluster`                                                                                  |
| build_command           | No       | String   | Required if the `method` is `git`. Specifies the build command.                                                                                                  |
| after_build_command     | No       | String   | Required if the `method` is `git` and `rendering` is `static` or `csr`. Specifies the command to run after build.                                               |
| start_app_command       | No       | String   | Required if the `method` is `git` and `rendering` is `ssr`. Specifies the command to start the application.                                                     |
| port                    | No       | Numeric  | Required if the `method` is `git` and `rendering` is `ssr`. Specifies the port number. Checks for availability.                                                |
| environment_variable    | No       | Array    | Optional. An array of associative arrays with `variable_name` and `variable_value`. Each environment variable must have both `variable_name` and `variable_value`. Only applicable if the `method` is `git`. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "name": "test-app",
    "method": "git",
    "framework": "github",
    "temp_domain": 0,
    "temp_sub_domain_name": "",
    "hostname": "test-app.xyz",
    "systemUser": "existing",
    "systemUserId": 64,
    "systemUserInfo": {
      "username": "htyDFG7jugd",
      "password": "qswaefrd"
    },
    "webroot": "",
    "www": false,
    "type": "private",
    "file_name": "oQUmjZjxc51B1Hyzk9xPhyjTOtWcRIXw",
    "git_provider_id": 12,
    "repository": "louislam/uptime-kuma",
    "username": "test",
    "repository_name": "uptime-kuma",
    "branch": "master",
    "rendering": "ssr",
    "package_manager": "npm",
    "process_mode": "fork",
    "build_command": "npm run setup",
    "after_build_command": null,
    "start_app_command": "npm start",
    "port": 8000,
    "environment_variable": [
        {
            "variable_name": "UPTIME_KUMA_PORT",
            "variable_value": "8000"
        }
    ],
  }'
```

### Response:

#### Application Created:

- __200__ (Ok)

```json
{
  "message": "Github application has been installed successfully!",
  "application": {
    "id": 5,
    "system_user_id": 4,
    "framework": "github",
    "name": "myapp",
    "primary_domain": "my-app.com",
    "webroot": null,
    "php_version": "8.2",
    "pm_type": "ondemand",
    "pm_max_children": 20,
    "pm_start_servers": 2,
    "pm_min_spare_servers": 1,
    "pm_max_spare_servers": 3,
    "pm_process_idle_timeout": 30,
    "pm_max_requests": 500,
    "pm_max_spawn_rate": 1,
    ....
  }
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Allowed Applications
- __500__ (Internal Server Error)

```json
{
  "message": "You cannot add more than {Your Subscription Allowed Applications} applications in this account. Please upgrade or contact support."
}
```

#### Temporary Domain Error
- __500__ (Internal Server Error)

```json
{
  "message": "You cannot add temporary domain. Because your server is free."
}
```

#### Duplicate Primary Domain
- __500__ (Internal Server Error)

```json
{
  "message": "Duplicate domain name found for this server."
}
```

#### Duplicate Application Name
- __500__ (Internal Server Error)

```json
{
  "message": "Duplicate application name found for this server."
}
```

#### Duplicate System User
- __500__ (Internal Server Error)

```json
{
  "message": "Duplicate  application user username found for this server."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Failed to create FTP user on server. Please try again after some time."
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```