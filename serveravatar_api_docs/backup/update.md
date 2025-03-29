# Update schedules

Use this method to update an existing schedule backup.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/backups/{backupConfiguration}
```

### Parameter:

| Parameters     | Required | Type      | Description      |
|:------------- |:------------- |:--------------|:----------------- |
| provider | Yes | String | Select your cloud storage provider: `gdrive`, `amazon_s3`, `dropbox`, `serveravatar`, `wasabi`, or `custom_s3`. |
| cloud_storage_provider_id | Yes | Numeric | Your integrated cloud storage provider id. |
| automatic_backup | Yes | Boolean | `true` or `false` |
| type | Yes | String | Specify the current or existing type during an update. Note: Use an existing type to ensure accuracy. |
| application_id | Yes | Numeric | Specify the current or existing `application ID` during an update. **Note:** Use an existing `application ID` for consistency. |
| database_id | No | Numeric | Specify the current or existing `database ID` during an update. **Note:** Use an existing `database ID` for consistency. |
| schedule | No | String | Required if, automatic_backup is `true`. List of the schedule presets: `Every Hour`, `Every 3 Hours`, `Every 6 Hours`, `Every 12 Hours`, `Every Day`, `Every 2 Days`, `Every Week`, `Every Month`,`Twice a Month`, `Every 3 Months`, `Every 6 Months`, or `Every Year` |
| retention_period | No | String | Required if, provider is `serveravatar`. List of the retention_period presets: `1 Month`, `2 Months`, `3 Months`, `6 Months`, `12 Months`, or `24 Months` |
| start_backup_from_now | No | Boolean | `true` or `false` |
| start_backup | No | String | Required if, start_backup_from_now is `false`. Start backup format is : `Y-m-d H:i ("2025-01-26 17:49")` |
| application_extension | No | String | Required if, type is application, or filesystem. Validate extension: `.tar`, or `.tar.gz` |
| database_extension | No | String | Required if, type is application, or database. Validate extension: `.sql`, or `.sql.gz` |

### Curl Request Example

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/5/servers/15/backups/7" \
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

#### Success Response

- __200__ (OK)

```json
{
    "message": "Backup plan updated successfully."
}
```

#### Cloud Storage Provider Not Found
- __404__ (Not Found)

```json
{
    "message": "Cloud storage provider not found."
}
```

#### Backup Schedule Not Found
- __404__ (Not Found)

```json
{
    "message": "Backup schedule not found."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
    "message": "Something went wrong."
}
```
