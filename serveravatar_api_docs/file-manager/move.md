# Move file/folder

Move the file or folder from one location to another.

### HTTP Request:
```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file/move
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| selected_files | Yes | Array | Your selected file or folder name. |
| destination | No | String | Destination path of file or folder. |
| path | No | String | A path of file or folder. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file/move" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "selected_files": ["api.php"],
      "path": "public_html",
      "destination": ""
    }'
```

### Response:

#### File Move:

- __200__ (Ok)

```json
{
    "message":"Files or Directories move successfully!"
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
