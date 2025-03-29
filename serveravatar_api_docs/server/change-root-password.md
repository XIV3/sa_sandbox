# Change Root Password

This API endpoint allows users to change the root password for a specified server. The request must include the new password and follow certain validation rules.

### HTTP Request:

```
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/change-root-password
```

### Parameters

| Parameter | Required | Type   | Description                                                                 |
|:----------|:--------|:-------|:----------------------------------------------------------------------------|
| password                | Yes     | String | The new root password for the server's database. Must not contain quotes or spaces. |
| password_confirmation    | Yes     | String | Confirmation of the new root password. Must match the `password` field and cannot contain quotes or spaces. |

### Validation Rules

- **Required**: Both `password` and `password_confirmation` must be provided.
- **Max Length**: The password can be up to 255 characters.
- **Format**: The password cannot contain single quotes (`'`), double quotes (`"`), or spaces.
- **Confirmation**: The `password_confirmation` must match the `password`.

### Example Request

#### cURL Request Example

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/change-root-password" \
  --header 'Content-Type: application/json' \
  --header 'Accept: application/json' \
  --header 'Authorization: <Your API Token>' \
  --data '{
    "password": "new_secure_password",
    "password_confirmation": "new_secure_password"
  }'
```

### Success Response

- __200__ (Ok)

```json
{
  "message": "Database root password changed successfully."
}
```

### Error Responses

- __500__ (Internal Server Error)

```json
{
  "message": "Failed to update database root password. Please try again later."
}
```