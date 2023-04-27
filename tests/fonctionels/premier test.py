from selenium import webdriver
from selenium.webdriver.common.by import By
import time

domainName= 'mdl'

driver = webdriver.Chrome()
driver.get("http://"+domainName)
if("Exception" in driver.find_element(By.CLASS_NAME,"active").get_attribute("innerHTML")):
    print("erreur symfony")
else:
    print ("fonctionnel")
time.sleep(5)
driver.quit()
print("fin de tentative d\'ouverture de la page d'accueil")