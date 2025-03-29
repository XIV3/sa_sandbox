# Restore 

Restore the backup

## Same Server

### HTTP Request:
```js
GET https://api.serveravatar.com/organizations/{organization}/backups/{backupId}/restore
```

### Curl Request example:

```sh
curl --request GET \
  --url "https://api.serveravatar.com/organizations/5/backups/10/restore" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

## Another Server

### HTTP Request:
```js
POST https://api.serveravatar.com/organizations/{organization}/backups/{backup}/restore-to-another-server
```

### Parameter:

| Parameter  | Required | Type    | Description                                                        |
|:-----------|:---------|:--------|:-------------------------------------------------------------------|
| server_id  | Yes      | Integer | The ID of the target server where the backup should be restored.   |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/backups/10/restore-to-another-server" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "server_id": 12
  }'
  ```

### Response:

#### Backup Details:

- __200__ (Ok)

```json
{
  "message": "Application backup restored in progress."
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not found
- __404__ (Not Found)

```json
{
    "message": "Application not found."
}
```

#### Database Not found
- __404__ (Not Found)

```json
{
    "message": "Database not found."
}
```
#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found."
}
```

#### Backup Not Found
- __404__ (Not Found)

```json
{
    "message": "Backup not found."
}
```

#### Already In Progress
- __500__ (Internal Server Error)

```json
{
    "message": "Restore is already in progress."
}
```
#### Disk Error
- __500__ (Internal Server Error)

```json
{
    "message": "You can not restore this backup because there is not enough disk space available on your server."
}
```

#### Disk Error
- __500__ (Internal Server Error)

```json
{
    "message": "You can not restore this backup because there is not enough disk space available on selected server."
}
```

#### Application Limit Exceeded
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot add more than {Your Subscription Allowed Applications} applications in this account. Please upgrade or contact support."
}
```

#### Server Not Connected
- __500__ (Internal Server Error)

```json
{
    "message": "Your server is not connected."
}
```

#### Application Exists
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot restore the backup because {Your application name} application already exists on the selected server."
}
```

#### Duplicate Domain Name Found
- __500__ (Internal Server Error)

```json
{
    "message": "Application domain is already exists on the selected server."
}
```

#### Database Exists
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot restore the backup because the database already exists on the selected server."
}
```

#### Database User Exists
- __500__ (Internal Server Error)

```json
{
    "message": "You cannot restore the backup because database users already exist on the selected server."
}
```

#### Unsupported Web Server
- __500__ (Internal Server Error)

```json
{
    "message": "Backups cannot be restored to MERN servers."
}
```

#### Unsupported Web Server
- __500__ (Internal Server Error)

```json
{
    "message": "Backups cannot be restored from MERN server to another server."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong."
}
```