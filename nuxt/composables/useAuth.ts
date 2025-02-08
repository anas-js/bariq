

// console.log(cookie.get());

export const useAuth = () => {
  interface User {
    name: string;
    username: string;
    email: string;
  }

  const user = useState("user", () => null as null | User);
  const loggedIn = useState("isLoggedIn", () => false);



  const setUser = (userSet: User) => {
    user.value = userSet;
  };

  const setLoginStatus = (status: boolean) => {
    loggedIn.value = status;
  };

  const login = async (user: User) => {
    setUser(user);
    setLoginStatus(true);

  };

  const logout = async () => {

  };

  const update = (callback : (user : User) => User) => {
    setUser(callback(user.value!));
  };

  return readonly({
    user,
    loggedIn,
    setUser,
    login,
    logout,
    setLoginStatus,
    update
  });
};
