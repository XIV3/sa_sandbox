# Delete

To Delete a Process.

### HTTP Request:

```
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}
```

### Curl Request Example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/supervisors/{supervisor}" \
  --header 'content-type: application/json' \
  --header 'accept: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
```

### Response:

#### Delete a Process:
- __200__ (Ok)

```json
{
  "message": "Supervisor process has been deleted successfully!!"
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

#### Server Error
- __500__ (Internal Server Error)

```json
{
  "message": "Something went really wrong!"
}