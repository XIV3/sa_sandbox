# Compress

Compress the file or folder(.zip, .tar, .tar.gz, .tar.bz2) from given types.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/file-managers/file/compress
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| type | Yes | String | Select any one: .zip, .tar, .tar.gz, .tar.bz2.  |
| name | Yes | String | Name of compress file or folder. |
| path | No | String | A path where you want to compress a file or folder. |
| selected_files | Yes | Array | Your selected file or folder name. |


### Curl Request example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/applications/92/file-managers/file/compress" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "name": "test",
      "path": "/public_html",
      "selected_files": ["api.php"],
      "type": ".zip"
    }'
```

### Response:

#### Compress File:

- __200__ (Ok)

```json
{
    "message":"Successfully .zip file created."
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
