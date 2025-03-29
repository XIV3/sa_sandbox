# Moodle

Install a moodle in your application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/servers/{server_id}/applications/{application_id}/auto-installer/moodle
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| fullname | Yes | String | The fullname of your moodle site. |
| shortname | Yes | String | The shortname of your moodle site. |
| email | No | String | The email of your moodle site. |
| summary | Yes | String | The summary of your moodle site. |
| username | Yes | String | The username of your moodle site. |
| password | Yes | String | The password of your moodle site. |
| support_email | No | String | The support email for moodle site. |
| database_server | No | Numeric | Database server ID, if you want to remote database server. |
| database_name | Yes | Alpha-Numeric | Name of the database. |
| php_version | Yes | String | 7.3 |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/servers/623/applications/724/auto-installer/moodle" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "fullname":"fullname",
    "shortname":"shortname",
    "summary":"moodleapp",
    "username":"username",
    "password":"username@123",
    "php_version":"7.3",
    "database_name":"moodleapp"
}'
```

### Response:

#### Install moodle

- __200__ (Ok)

```json
{
  "message":"Application has been deployed in moodle successfully!"
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