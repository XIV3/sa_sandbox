# Get file content

Use this method to get a content of the file.

### HTTP Request:
```js
GET https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file?path={your path name}&filename={your file name}
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file?path=public_html&filename=api.php" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Get File Content:

- __200__ (Ok)

```json
{
    "{ Your File Content }"
}
```

#### Invalid Request
- __500__ (Internal Server Error)
```json
{
    "message": "Invalid Request!"
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
