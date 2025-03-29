# Create

Create a file/folder for the application.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file/create
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| type | Yes | String | `file`, or `folder` |
| name | Yes | String | Name of file or folder. |
| path | No | String | A path where you want to create a file or folder. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file/create" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "name": "api.php",
      "path": "/public_html",
      "type": "file"
    }'
```

### Response:

#### File Create:

- __200__ (Ok)

```json
{
	"message":"Successfully file created."
}
```

#### Already Exists 
- __500__ (Internal Server Error)
```json
{
    "message": "File or Folder name already exists!"
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
