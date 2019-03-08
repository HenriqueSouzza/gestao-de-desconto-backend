FROM nginx:1.13
RUN rm /etc/nginx/conf.d/default.conf
ADD docker/vhost.conf /etc/nginx/conf.d/default.conf
RUN chmod 777 /etc/nginx/conf.d/default.conf

# Clean
RUN apt-get clean -y