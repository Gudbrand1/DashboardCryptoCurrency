IF the CURL Error 60 show up on Localhost just neeed to the most upvoted answer here :
https://stackoverflow.com/questions/35638497/curl-error-60-ssl-certificate-prblm-unable-to-get-local-issuer-certificate

If you are on Windows using Xampp, I am stealing a better answer from here, would be helpful if Google shows you this question first.

    Download and extract for cacert.pem here (a clean file format/data)

        https://curl.haxx.se/docs/caextract.html

    Put it in :

        C:\xampp\php\extras\ssl\cacert.pem

    Add this line to your php.ini

        curl.cainfo = "C:\xampp\php\extras\ssl\cacert.pem"

    restart your webserver/Apache

