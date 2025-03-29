# Destroy

Delete a specific application present on the server.

### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Application Delete
- __200__ (Ok)

```json
{
    "message":"Application has been deleted successfully!"
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
    "message":"Application not found!"
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
    "message":"Something went really wrong!"
}
```