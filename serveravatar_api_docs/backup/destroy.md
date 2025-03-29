# Delete

Delete the created backup and Backup data will be removed from your storage area.

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/backups/destroy
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| ids | Yes | Array | Backup ids. |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/backups/destroy" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
        "ids": [10]
    }'
```

### Response:

#### Backup Delete:

- __200__ (Ok)

```json
{
  "message": "Backup files successfully deleted from your cloud storage provider."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Deletion Failed
- __500__ (Internal Server Error)

```json
{
    "message": "Backup deletion process is failed!"
}
```
#### Permission Error
- __500__ (Internal Server Error)

```json
{
    "message": "You can not perform this action!"
}
```
#### Not Complete
- __500__ (Internal Server Error)

```json
{
    "message": "Backup not completed."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```