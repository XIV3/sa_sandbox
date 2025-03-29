# Delete file/folder

Delete the file or folder. note that, you can't restore it once you deleted.


### HTTP Request:
```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file/delete
```

### Parameter:

| Parameters    | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| selected_files | Yes | Array | Your selected file or folder name. |
| path | No | String | A path of file or folder. |


### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file/delete" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "selected_files": ["test.php"],
      "path": "/public_html"
    }'
```

### Response:

#### File Delete:

- __200__ (Ok)

```json
{
    "message":"Files or Directories deleted successfully!"
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
