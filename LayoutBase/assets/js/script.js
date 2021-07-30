const hostName = 'https://covidanalytics-grupo5.test/';
// Login / Logout
async function login(data = {}) {
  return await apiCall('POST', hostName + '/api/login', null, data);
};

async function logout(token) {
  return await apiCall('POST', hostName + '/api/logout', token, null);
};

// Pais por fecha
async function consultaPaisDia(token) {
  return await apiCall('GET', hostName + '/api/entries', token, null);
};

async function consultasuma(token, data = {}) {
  return await apiCall('GET', hostName + '/api/entries',token, data);
};

const apiCall = async (method, url, token = null, data = null) => {
  let config = {
    method: method,
    url: url,
  }

  if (token !== null) {
    config['headers'] = {'Authorization': `Bearer ${token}`};
  }

  if (data !== null) {
    config['data'] = data;
  }

  const response = await axios(config);

  return response.data;
}

// Exportación de las funciones

export {
  login,
  logout,
  consultaPaisDia,
  consultasuma,
}