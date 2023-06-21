import time

import selenium
from selenium import webdriver
from selenium.webdriver import DesiredCapabilities
from selenium.webdriver.common.by import By
from selenium.webdriver.remote.webelement import WebElement
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.firefox.options import Options
from selenium.webdriver.common.keys import Keys

SIGN_IN_URL = "http://localhost/see/login.html"
COMMENT = "This is a test"


def test_login():
    c = Options()
    # adding headless parameter to webdriver object
    # c.add_argument("--headless")

    browser = webdriver.Firefox(executable_path=r"C:\Windows\geckodriver.exe", options=c)
    wait = WebDriverWait(browser, 10)

    browser.get(SIGN_IN_URL)

    # Shawshank
    login_button = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/div/div/div/div/div/form/div[1]/button')))
    login_button.click()

    time.sleep(3)

    token = browser.execute_script('return window.localStorage.getItem("token");')
    assert token != ""

    menu = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/div[1]/nav/div/div/div/button')))
    menu.click()

    logout_button = wait.until(EC.element_to_be_clickable((By.XPATH, '/html/body/div[1]/nav/div/div/div/ul/li[4]/a')))
    logout_button.click()

    time.sleep(3)
    token = browser.execute_script('return window.localStorage.getItem("token");')


    assert token == None
    # browser.quit()




test_login()