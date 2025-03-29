# Download

Download backup

### HTTP Request:

```js
GET https://api.serveravatar.com/organizations/{organization}/backups/{backupId}/{type:['filesystem','database']}/download
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/backups/10/filesystem/download" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Download File:

- __200__ (Ok)

```json
{
  "temporaryUrl": "https://serveravatar.s3.eu-central-1.wasabisys.com/MYeY5DQkJpterbbpTrwG4PerqRiOiawDM9s.tar?response-content-disposition=attachment%3B%20filename%3DServeravatarApp.tar&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=K6DTONHF5HX6GW9OY8V7F%2F20210819%2Feu-central-1%2Fs3%2Faws4_request&X-Amz-Date=20266819T104840Z&X-Amz-SignedHeaders=host&X-Amz-Expires=60&X-Amz-Signature=30d61ted773ceaaa4e2d1a4h578a677abea6169b780c43a2abc06dbef153fe3daaae"
}
```
#### Backup Not Found
- __404__ (Not Found)

```json
{
    "message": "Backup not found!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### URL Error
- __500__ (Internal Server Error)

```json
{
    "message": "Wasabi not generated url for download file!"
}
```

#### Permission Error
- __500__ (Internal Server Error)

```json
{
    "message": "You can not perform this action!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```