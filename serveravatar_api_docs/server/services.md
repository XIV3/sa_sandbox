# Services

## List Services

Get a list of all services.


### HTTP request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/services
```

### Curl Request Example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/services" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Server Services List
- __200__ (Ok)

``` json
{
  "services": [
    {
      "name": "nginx",
      "status": true,
      "resourceUsage": {
        "ram": 1.4,
        "cpu": 0
      }
    },
    {
      "name": "mariadb",
      "status": true,
      "resourceUsage": {
        "ram": 0.7,
        "cpu": 0
      }
    },
    {
      "name": "postfix",
      "status": true,
      "resourceUsage": {
        "ram": 2.3,
        "cpu": 0
      }
    },
    .....
  ]
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
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
    "message": "Something went really wrong!"
}
```

## Service Update

Update services on the server.


### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/services
```

### Parameter:

| Parameters     | Required | Value      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| service | Yes | String | Select any one service: `apache2`, `nginx` , `mysql`, `mariadb`, `mongod`, `php7.0-fpm`, `php7.1-fpm`, `php7.2-fpm`, `php7.3-fpm`, `php7.4-fpm`, `php8.0-fpm`, `php8.1-fpm`, `php8.2-fpm`, `php8.3-fpm`, `php8.4-fpm`,`postfix`, `ssh`, `ufw` or `redis`. |
| action | Yes | String | Select any one action: `start`, `stop`, `restart`, or `reload`. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/services" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "service": "php7.4-fpm",
    "action": "stop"
  }'
```

### Response:

#### Server Service Update
- __200__ (Ok)

``` json
{
  "message": "php7.4-fpm has been stop successfully!"
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
  "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Invalid Input

- __500__ (Internal Server Error)

```json
{
    "message": "The data provided is invalid!"
}
```

#### Server Error

- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```

## Get PHP-FPM Content

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/services/php-fpm
```

### Parameters:

| Parameter   | Required | Type   | Description                                  |
|-------------|----------|--------|----------------------------------------------|
|   service   | Yes      | String | Select any one service from `php7.0-fpm`, `php7.1-fpm`, `php7.2-fpm`, `php7.3-fpm`, `php7.4-fpm`, `php8.0-fpm`, `php8.1-fpm`, `php8.2-fpm`, `php8.3-fpm`, `php8.4-fpm` to retrieve the PHP FPM configuration. |

### Curl Request Example:
```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/services/php-fpm" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "service": "php8.1-fpm"
  }'
```

### Response:

#### Success Response:
- __200__ (Ok)

```json
{
    "content": {
        "data": "; Start a new pool named 'www'.\n; the variable $pool can be used in any directive and will be replaced by the\n; pool name ('www' here)\n[www]\n\n; Per pool prefix\n; It only applies on the following directives:\n; - 'access.log'\n; - 'slowlog'\n; - 'listen' (unixsocket)\n; - 'chroot'\n; - 'chdir'\n; - 'php_values'\n; - 'php_admin_values'\n; When not set, the global prefix (or /usr) applies instead.\n; Note: This directive can also be relative to the global prefix.\n; Default Value: none\n;prefix = /path/to/pools/$pool\n\n; Unix user/group of the child processes. This can be used only if the master\n; process running user is root. It is set after the child process is created.\n; The user and group can be specified either by their name or by their numeric\n; IDs.\n; Note: If the user is root, the executable needs to be started with\n; ....",
        "status": "success"
    }
}
```

#### Unsupported Web Server:
- __500__ (Internal Server Error)

```json
{
    "message": "The selected web server is not supported for this operation."
}
```

#### Unsupported Service:
- __500__ (Internal Server Error)

```json
{
    "message": "The requested service {service} is not available on this server."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong."
}
```

## Update PHP-FPM Content

Update PHP-FPM Content

### HTTP Request:
```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/services/php-fpm
```

### Parameters

| Parameter    | Required | Type   | Description                                |
|--------------|----------|--------|--------------------------------------------|
|   service    | Yes      | String | Select any one Service: `php7.0-fpm`, `php7.1-fpm`, `php7.2-fpm`, `php7.3-fpm`, `php7.4-fpm`, `php8.0-fpm`, `php8.1-fpm`, `php8.2-fpm`, `php8.3-fpm`, `php8.4-fpm` to update the PHP FPM configuration.  |
|   content    | Yes      | String | Updated content for the PHP-FPM INI file.  |

### Curl Request Example

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/services/php-fpm" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "service": "php8.1-fpm",
      "content": "; Start a new pool named 'www'.\n; the variable $pool can be used in any directive and will be replaced by the\n;...."
  }'
```

### Response:

### Success Response
- __200__ (OK)

```json
{
    "message": "PHP-FPM INI file content updated successfully."
}
```

#### Unsupported Web Server
- __500__ (Internal Server Error)

```json
{
    "message": "The selected web server is not supported for this operation."
}
```

#### Unsupported Service:
- __500__ (Internal Server Error)

```json
{
    "message": "The requested service {service} is not available on this server."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong."
}
```

