# Mautic

Install a mautic in your application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/servers/{server_id}/applications/{application_id}/auto-installer/mautic
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| firstname | Yes | String | The firstname of your mautic site. |
| lastname | Yes | String | The lastname of your mautic site. |
| email | No | String | The email of your mautic site. |
| title | Yes | String | The title of your mautic site. |
| username | Yes | String | The username of your mautic site. |
| password | Yes | String | The password of your mautic site. |
| mailer_name | Yes | String | The mailer name for email configuration. |
| mailer_email | No | String | The mailer email for email configuration. |
| mailer_host | Yes | String | The mailer host for email configuration. |
| mailer_port | Yes | Numeric | The mailer port for email configuration. |
| mailer_username | Yes | String | The mailer username for email configuration. |
| mailer_password | Yes | String | The mailer password for email configuration. |
| database_server | No | Numeric | Database server ID, if you want to remote database server. |
| database_name | Yes | Alpha-Numeric | Name of the database. |
| php_version | Yes | String | 7.4 |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/servers/623/applications/724/auto-installer/mautic" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "firstname":"firstname",
    "lastname":"lastname",
    "title":"mauticapp",
    "username":"username",
    "password":"username@123",
    "mailer_name":"test",
    "mailer_host":"test",
    "mailer_port":22,
    "mailer_username":"test",
    "mailer_password":"test@123",
    "php_version":"7.4",
    "database_name":"mauticapp"
}'
```

### Response:

#### Install mautic

- __200__ (Ok)

```json
{
  "message":"Application has been deployed in mautic successfully!"
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