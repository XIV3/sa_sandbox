# Joomla

Install a joomla in your application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/servers/{server_id}/applications/{application_id}/auto-installer/joomla
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| php_version | Yes | String | Supported php version, 7.2, 7.3, 7.4, 8.0 |

### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/servers/623/applications/724/auto-installer/joomla" \
  --header 'Content-Type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "php_version":"7.3"
}'
```

### Response:

#### Install joomla

- __200__ (Ok)

```json
{
  "message":"Application has been deployed in joomla successfully!"
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