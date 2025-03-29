# Tags

## Show

You can view the tags assigned to a specific server or retrieve all tags across multiple servers using the respective APIs.

- __Fetch Tags for a Specific Server__: To retrieve the tags associated with a specific server, use the [API](show.md).

- __Fetch Tags for All Servers__: To get a complete list of servers along with their assigned tags, use the [API](./).


## Update

Update the tags associated with a specific server for better categorization and management.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/tags
```
### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/tags" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "tags": ["Tag1", "Tag2", "Tag3"]
  }'
```

### Response:

#### Tags Update
- __200__ (Ok)

``` json
{
  "message": "Tags updated successfully."
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
    "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found."
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went wrong."
}
```


## Delete

Delete all tags associated with a specific server.


### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/tags
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/tags" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```

### Response:

#### Tags Delete
- __200__ (Ok)

``` json
{
  "message": "Tags removed successfully."
}
```

#### Organization Not Found
- __404__ (Not found)

```json
{
    "message": "Organization not found."
}
```

#### Server Not Found
- __404__ (Not Found)

```json
{
    "message": "Server not found."
}
```

#### Server Error
- __500__ (Internal Server Error)
```json
{
    "message": "Something went wrong."
}