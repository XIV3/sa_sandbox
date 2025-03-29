# Create

Use this method to create a fresh backup.

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/backups
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| name | No | String | Provide name while creating an instant backup. Only for an instant backup. |
| provider | Yes | String | Select your cloud storage provider: `gdrive`, `amazon_s3`, `dropbox`, `serveravatar`, `wasabi`, or `custom_s3`. |
| cloud_storage_provider_id | Yes | Numeric | Your integrated cloud storage provider id. |
| automatic_backup | Yes | Boolean | `true` or `false` |
| type | Yes | String | Select any one Type for your backup: `filesystem`, `database`, or `application`. |
| application_id | Yes | Numeric | Your server application id. |
| database_id | No | Numeric | Your server database id. |
| schedule | No | String | Required if, automatic_backup is `true`. List of the schedule presets: `Every Hour`, `Every 3 Hours`, `Every 6 Hours`, `Every 12 Hours`, `Every Day`, `Every 2 Days`, `Every Week`, `Every Month`,`Twice a Month`, `Every 3 Months`, `Every 6 Months`, or `Every Year` |
| retention_period | No | String | Required if, provider is `serveravatar`. List of the retention_period presets: `1 Month`, `2 Months`, `3 Months`, `6 Months`, `12 Months`, or `24 Months` |
| start_backup_from_now | No | Boolean | `true` or `false` |
| start_backup | No | String | Required if, start_backup_from_now is `false`. Start backup format is : `Y-m-d H:i ("2023-07-13 17:49")` |
| application_extension | No | String | Required if, type is application, or filesystem. Validate extension: `.tar`, or `.tar.gz` |
| database_extension | No | String | Required if, type is application, or database. Validate extension: `.sql`, or `.sql.gz` |

### Curl Request example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/5/servers/15/backups" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "cloud_storage_provider_id": 10,
    "automatic_backup": 1,
    "type": "application",
    "application_id": 4246,
    "database_id": 4223,
    "provider": "wasabi",
    "schedule": "Every Hour",
    "retention_period": "1 Month",
    "start_backup_from_now": 1,
    "start_backup": null,
    "application_extension": ".tar.gz",
    "database_extension": ".sql.gz"
  }'
```

### Response:

#### Automatic Backup Create
**200** (Ok)

```json
{
  "message": "Backup plan created successfully."
}
```

#### Instant Backup
**200** (Ok)

```json
{
  "message": "Backup Process has been started successfully!"
}
```

#### Organization Not Found
- __404__ (Not Found)

```json
{
    "message": "Organization not found!"
}
```

#### Application Not Found
- __404__ (Not Found)
```json
{
    "message": "Application not found!"
}
```

#### Cloud Storage Provider Not Found
- __404__ (Not Found)
```json
{
    "message": "Cloud storage Provider not found!"
}
```

#### Database Not Found
- __404__ (Not Found)
```json
{
    "message": "Database not found!"
}
```

#### Invalid Schedule
- __500__ (Internal Server Error)
```json
{
    "message": "Invalid schedule!"
}
```

#### Choose Future Start Date 
- __500__ (Not Found)
```json
{
    "message": "Start from choose future date!"
}
```

#### Instant Backup Failed
- __500__ (Not Found)
```json
{
    "message": "Instant Backup is failed because you do not have enough disk space available on your server."
}
```

#### Invalid Retention Period
- __500__ (Internal Server Error)
```json
{
    "message": "Invalid retention period!"
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found!"
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went really wrong!"
}
```