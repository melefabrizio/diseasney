import React from 'react';
import logo from './logo.svg';
import './App.css';

import 'antd/dist/antd.css';
import Table from 'antd/lib/table/Table'
import axios from 'axios'
import { Button, Input, Layout } from 'antd/lib'
import Menu from 'antd/lib/menu'
import { SearchOutlined } from '@ant-design/icons';


const {Header, Footer, Sider, Content} = Layout;


export class App extends React.Component{

  state = {
    movies: [],
    allMovies: [],
    search: "",

  }

  componentDidMount () {
    console.log(process.env)

    axios.get(process.env.REACT_APP_API_URL+"/movies")
      .then( res => {
        const movies = res.data
        console.log(movies)

        this.setState({allMovies:movies, movies:movies})
      })
  }
  onFilter= e =>{
    this.setState({
      movies: this.state.allMovies.filter( rec => rec.title.toLowerCase().includes(e.target.value.toLowerCase()))
    })
  }

  getMovies = () => {
    console.log(this.state.movies)
  }

  render() {
    const columns = [
      {
        title: 'Title',
        dataIndex: 'title',
        key: 'title',
        sorter: (a,b) => a.title.toLowerCase().localeCompare(b.title.toLowerCase()),

      },
      {
        title: 'Year',
        dataIndex: 'year',
        key: 'year',
        sorter:(a,b) => a.year-b.year
      },
      {
        title: 'Animation Type',
        dataIndex: 'animation',
        key: 'animation',
        sorter: (a,b) => a.animation.toLowerCase().localeCompare(b.animation.toLowerCase())
      },
      {
        title: 'Average Overall Score',
        dataIndex: 'avg_overall',
        key: 'avg_overall',
        sorter:(a,b) => a.avg_overall-b.avg_overall
      },
      {
        title: 'Average Music Score',
        dataIndex: 'avg_score',
        key: 'avg_score',
        sorter:(a,b) => a.avg_score-b.avg_score
      },
      {
        title: 'Average Animation Score',
        dataIndex: 'avg_animation',
        key: 'avg_animation',
        sorter:(a,b) => a.avg_animation-b.avg_animation
      },
      {
        title: 'Average Universe Score',
        dataIndex: 'avg_universe',
        key: 'avg_universe',
        sorter:(a,b) => a.avg_universe-b.avg_universe
      },
    ]
    return (
    <Layout className="layout">
      <Header>
        <div className="logo" />
        <Menu theme="dark" mode="horizontal" defaultSelectedKeys={['1']}>
          <Menu.Item key="1">Movies</Menu.Item>
          <Menu.Item key="2">Rate Movie</Menu.Item>
          <Menu.Item key="3">Log In</Menu.Item>




        </Menu>
      </Header>
      <div style={{padding:'50px'}}>
      <Input
        size={"large"}
        placeholder={"Search"}
        prefix={<SearchOutlined/>}
        onChange={this.onFilter}
      />
      <Content >
        <Table
          dataSource={this.state.movies}
          columns={columns}
          pagination={false}
          scroll={{y:"60vh"}}

        />
      </Content>
      </div>
    </Layout>

    )
  }
}

