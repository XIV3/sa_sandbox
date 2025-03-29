# Destroy

To delete the database user. You can not retrieve the database user once you delete it.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/databases/{database}/database-users/delete
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ids | Yes | Array | Database user ids. |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/databases/48/database-users/delete" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "ids": [53]
    }'
```

### Response:

#### Database User Delete
- __200__ (Ok)

```json
{
    "message": "Database user has been deleted successfully!"
}
```

#### Database User Not Found
- __404__ (Not Found)

```json
{
    "message": "Database user not found!"
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
    "message": "Database not found!"
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

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```