# Destroy

To delete the database. 


### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases/{database}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases/48" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Database Delete
- __200__ (Ok)

```json
{
    "message": "Database has been deleted successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message":"Organization not found!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message":"Server not found!"
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
    "message": "Database not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong while deleting database!"
}
```