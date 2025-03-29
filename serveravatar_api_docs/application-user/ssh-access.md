# SFTP/SSH Access Toggle

Enable or disable the SFTP/SSH access for the appliation user.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}/ssh-access
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}/ssh-access" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Successful Operation
- __200__ (Ok)

``` json
{
  "sftp_ssh_access": true,
  "message": "Application user has been updated successfully!"
}
```

#### Application User Not found
- __404__ (Not Found)

```json
{
    "message": "Application user not found!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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