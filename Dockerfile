FROM tutum/lamp
RUN rm -fr /app && git clone https://github.com/UltramanGaia/OAuth2.0-Demo-authorization.git /app
EXPOSE 80
EXPOSE 3306
CMD ["/run.sh"]


