# Remove

Remove staging area.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/remove-staging-area
```
### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/88/remove-staging-area" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

- __200__ (Ok)

``` json
{
  "message":"Staging site deleted successfully."
}
```

#### Permission Error
- __404__ (Not Found)

```json
{
    "message": "You cannot perform this action!"
}
```

#### Permission Error
- __404__ (Not Found)

```json
{
    "message": "You cannot perform this action, Please contact support!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
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