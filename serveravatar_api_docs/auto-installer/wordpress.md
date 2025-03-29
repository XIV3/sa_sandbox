# Wordpress

Install a wordpress in your application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/servers/{server_id}/applications/{application_id}/auto-installer/wordpress
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| title | Yes | String | The title of your WordPress site. |
| email | No | String | The email of your WordPress site. |
| username | Yes | String | The admin username of your WordPress site. |
| password | Yes | Numeric | The admin password of your WordPress site. |
| database_server | No | Numeric | Database server ID, if you want to remote database server. |
| database_name | Yes | Alpha-Numeric | Name of the database. |
| install_litespeed_cache_plugin | Yes | Boolean | If your web server openlitespeed then pass true/false, otherwise always false. |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/servers/623/applications/724/auto-installer/wordpress" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "title":"wordpressapp",
    "username":"username",
    "password":"username@123",
    "install_litespeed_cache_plugin":false,
    "database_name":"wordpress"
    }'
```

### Response:

#### Install Wordpress

- __200__ (Ok)

```json
{
  "message":"Application has been deployed in wordpress successfully!"
}
```

#### Forbidden
- __403__ (Forbidden)

```json
{
    "message": "You can not perform this action!"
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
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