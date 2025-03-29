# Rename

Use this method to rename the File or folder.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file/rename
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| file_name | Yes | String | Your old file name. |
| file_rename | Yes | String | Your new file name. |
| path | No | String | A path of file or folder. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file/rename" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "file_name": "api.php",
    "file_rename": "test.php",
    "path": "public_html"
    }'
```

### Response:

#### File Rename:

- __200__ (Ok)

```json
{
    "message":"Rename successfully."
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
