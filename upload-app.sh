lftp -e " \
        open $FTP_HOST; \
          \
        user $FTP_USERNAME $FTP_PASSWORD; \
          \
        mirror -X .* -X .*/ \
            --reverse \
            --verbose \
            --delete ./ www/$FTP_DIRECTORY/ \
              \ 
            --exclude public \
            --exclude vendor \
            --exclude node_modules \
            --exclude storage \
        ; \
          \
        bye \"