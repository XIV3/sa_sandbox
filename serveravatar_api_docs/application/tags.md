# Tags

## Show

You can view the tags assigned to a specific application or retrieve all tags across multiple applications on server using the respective APIs.

- __Fetch Tags for a Specific Application__: To retrieve the tags associated with a specific application, use the [API](show.md).

- __Fetch Tags for Applications on a Specific Server__: To get a complete list of applications within a server along with their assigned tags, use the [API](./#server-s-application-list).

- __Fetch Tags for Applications Across an Organization__: To get a complete list of applications across multiple servers within a organization along with their assigned tags, use the [API](./#organization-s-application-list).


## Update

Update the tags associated with a specific application on a server.

### HTTP Request:

```js
PATCH https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/tags
```
### Curl Request Example:

```sh
curl --request PATCH \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/tags" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>' \
  --data '{
      "tags": ["Tag1", "Tag2", "Tag3"]
  }'
```

### Response:

#### Application Not Found
- __404__ (Not found)

```json
{
    "message": "Application not found."
}
```

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

Delete all tags associated with a specific application on a server.


### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/tags
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}/applications/{application}/tags" \
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