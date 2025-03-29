# Update Permission

Update the permission of the file/folder.


### HTTP Request:
```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/permission-update
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| selected_files | Yes | Array | Your selected file or folder name. |
| path | No | String | Path of file or folder. |
| user | No | json | `read(r)`, `write(w)`, and `execute(x)` permission of user. |
| group | No | json | `read(r)`, `write(w)`, and `execute(x)` permission of group.|
| other | No | json | `read(r)`, `write(w)`, and `execute(x)` permission of other. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/permission-update" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "selected_files": [
      "api.php"
    ],
    "group": {
      "read": "r",
      "write": "w",
      "execute": "x"
    },
    "other": {
      "read": "r",
      "write": "",
      "execute": ""
    },
    "path": "/public_html",
    "user": {
      "read": "r",
      "write": "w",
      "execute": "x"
    }
  }'
```

### Response:

#### File Permission Update:

- __200__ (Ok)

```json
{
    "message":"Permissions change successfully!"
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

#### Application Not Found
- __404__ (Not Found)

```json
{
    "message": "Application not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went really wrong!"
}
```
