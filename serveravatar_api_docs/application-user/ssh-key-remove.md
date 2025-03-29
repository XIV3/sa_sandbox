# SSH Key Remove

Delete the SSH key for the application user.

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}/ssh-key-remove
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/{system_user}/ssh-key-remove" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### SSH Key Delete
- __200__ (Ok)

``` json
{
  "message": "SSH key removed successfully for {Application User Username}."
}
```

#### SSH Key Not found
- __404__ (Not Found)

```json
{
    "message": "SSH key not found!"
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