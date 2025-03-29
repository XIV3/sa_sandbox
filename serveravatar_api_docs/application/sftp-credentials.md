# SFTP Credentials

Get mail SFTP Credentials.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/sftp
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/sftp" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### SFTP Credentials Mail
- __200__ (Ok)

``` json
{
  "message": "SFTP credentials has been mailed successfully."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
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