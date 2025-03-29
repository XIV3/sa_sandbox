# Destroy

Delete the specific application user of the appliation.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/delete
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ids | Yes | Array | Application user ids. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/system-users/delete" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "ids": [53]
    }'
```

### Response:

#### Application User Delete
- __200__ (Ok)

```json
{
    "message": "Application user has been deleted successfully!"
}
```

#### Application Exists
- __500__ (Internal Server Error)

```json
{
    "message": "Application user has one or more than one application. It cannot be deleted!"
}
```

#### Application User Not Found
- __404__ (Not Found)

```json
{
    "message":"Application user not found!"
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
    "message":"Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message":"Something went wrong while deleting application user account!"
}
```