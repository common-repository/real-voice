The current version is 1.0.0 downloaded from:

https://github.com/Experience-Monks/audiobuffer-to-wav

The first line of the library has been removed to make it work with the browser:

```
module.exports = audioBufferToWav"
```

With the line present the following error was generated in the browser console:

```
index.js?ver=1.24:1 Uncaught ReferenceError: module is not defined at index.js?ver=1.24:1:1
```
