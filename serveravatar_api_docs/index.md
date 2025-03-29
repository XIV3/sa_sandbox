# Introduction

ServerAvatar API is organized around [RESTful](https://en.wikipedia.org/wiki/Representational_state_transfer). and allows you to manage ServerAvatar resources using HTTP requests. All the response returns in JSON formate, including errors. We accept form-encoded request body and return json-encoded response.



## Authentication

You can access API credentials from your [Account](https://app.serveravatar.com/register).
Take care to keep your API key secret. Note that only one API key is active at a time.



## Base URL

- The base URL for our API is
``` 
https://api.serveravatar.com
```
<mark style="background-color: #F1F1F1;">All request and response will be in JSON formatted output</mark>

<mark style="background-color: #F1F1F1;"> All requests to the API must be made over HTTPS.</mark>




## Status Code

We are using a satandard HTTP response status code that is friendly to API development.

| HTTP Code    | Status | Explanation |
| ------------ | ------ | ----------- |
| 200          | Ok     | The HTTP 200 OK success status response code indicates that the request has succeeded. |
| 401          | Unauthorized | The 401 Unauthorized Error is an HTTP response status code indicating that the request sent by the client could not be authenticated. |
| 403          | Forbidden | HTTP 403 is a standard HTTP status code communicated to clients by an HTTP server to indicate that access to the requested (valid) URL by the client is Forbidden for some reason |
| 404 | Not Found | 404 is status code that tells a Web user that a requested page or endpoint is not found. |
| 405 | Method Not Allowed | The method received in the request-line is known by the origin server but not supported by the target resource. |
| 422 | Unprocessable Entities | The 422 status code indicate that some fields are missing for current request which is require. |
| 429 | Too Many Request | Too Many Request. You will get this HTTP Code if you have exceeded rate limits. |
| 500 | Internal Server Error | The 500 status code, or Internal Server Error, means that server cannot process the request for an unknown reason. |
| 503 | Service Unavailable / Maintanance | The 503 Service Unavailable error is an HTTP status code that means the website's server is simply not available right now. Most of the time, it occurs because the server is too busy or because there's maintenance being performed on it. |




## Headers

- you need to Make sure that all the requests to our API have **`Content-Type:application/json`** headers.




## HTTP Methods

- Currently, We are using the following HTTP methods-

   - **GET**

   using GET mehtod, you can retrive data in JSON format. this method request a representation of the specific format.

   - **POST**

   POST method is used to send data to a server to create or update a resource.

   - **PATCH**

   you can use PATCH method for making partial changes to an existing resource.

   - **DELETE**

   the DELETE method deletes the specified resource.



## Rate Limit

The API rate limit defines the maximum number of requests a user or client can make per second. The rate limit is different based on the plan you select. Below are the rate limits for each plan:

- **Free plan**: **`60 Request/Minute`**
- **Starter plan**: **`120 Request/Minute`**
- **Professional plan**: **`150 Request/Minute`**
- **Master plan**: **`180 Request/Minute`**
- **Business plan**: **`210 Request/Minute`**

If you exceed the request limit, you will receive HTTP Code **`429 (Too Many Request)`** error.