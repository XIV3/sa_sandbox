# Remove Database

Remove Database from Application

### HTTP Request:

```js
POST https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/remove-database
```

### Parameter:

| Parameter   | Required | Type   | Description                       |
|-------------|----------|--------|-----------------------------------|
| database_id | Yes      | Numeric| ID of the specific database to be removed from the application.     |

### Curl Request Example:

```sh
curl --request POST \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/remove-database" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
    "database_id": 12
  }'
```

### Response Examples:

#### Database Removed Successfully
- __200__ (Ok)

```json
{
  "message": "Database removed successfully."
}
```

#### Application Not Found
- __404__ (Not Found)

```json
{
  "message": "The application is not associated with the specified server."
}
```

#### Database Not Found
- __404__ (Not Found)

```json
{
  "message": "The selected database is not found."
}
```

#### No Database Added to Application
- __400__ (Bad Request)

```json
{
  "message": "No database is currently added to the selected application."
}
```

#### Database Not Added to Application
- __422__ (Unprocessable Entity)

```json
{
  "message": "The selected database is not added to the application."
}
```

#### Server Error
- __500__ (Internal Server Error)

```json
{
  "message": "Something went wrong!"
}
```