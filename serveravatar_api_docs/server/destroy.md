# Destroy

Use this method to delete a server. note that, once the server is disconnect from ServerAvatar, you can not re-connect it without the help of support.


### HTTP Request:

```js
DELETE https://api.serveravatar.com/organizations/{organization}/servers/{server}
```

### Curl Request example:

```sh
curl --request DELETE \
  --url "https://api.serveravatar.com/organizations/{organization}/servers/{server}" \
  --header 'content-type: application/json' \
  --header 'Authorization: <YOUR API TOKEN>'
```
---
**NOTE**

- If you want to delete your server from the server provider, pass the { deleteFromProvider=1 } as a URL parameter.

---

### Response:

#### Organization Not Found
- __404__ (Not found)

```json
{
    "message": "Organization not found."
}
```

#### Server Delete
- __200__ (Ok)

``` json
{
  "message": "Server has been disconnected successfully!"
}
```

#### Forbidden
- __403__ (Forbidden)

```json
{
    "message": "You can not perform this action!"
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