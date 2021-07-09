lftp -e "                                 \
        open $FTP_HOST;                   \
                                          \
        user $FTP_USERNAME $FTP_PASSWORD; \
                                          \
        mirror -X .* -X .*/        \
            --reverse              \
            --verbose              \
            --exclude .idea        \
            --exclude public       \
            --exclude tests        \
            --exclude vendor       \
            --exclude node_modules \
            --exclude package.json \
       --exclude package-lock.json \
            --exclude storage      \
                                   \
            ./ www/$FTP_DIRECTORY/ \
        ;                          \
                                   \
        bye "